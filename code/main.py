import csv
from PIL import Image
import pytesseract
import cv2
import yaml

#form_type = sys.argv[1] # Which form
#image_name = sys.argv[2] # Image name
form_type = "APP3"
image_name = "APP3_form032.jpg"

with open("C://xampp//htdocs//UI//OCR_13//path.yaml", 'r') as stream:
    path = yaml.load(stream)
    path_pwd = path['path_pwd']
    path_tesseract = path['Tesseract-OCR']

path_image = path_pwd + '//input//' + form_type 
path_temp = path_pwd + '//temp//'
path_config = path_pwd + '//config'
path_config_file = path_config + '//' +form_type +'.csv'
path_archive=path_pwd + '//archive' 
pytesseract.pytesseract.tesseract_cmd =path_tesseract + '//tesseract'

#img = Image.open(path_image + '//' +image_name)

img = cv2.imread(path_image + '//' + image_name,1)
b,g,r = cv2.split(img)           # get b,g,r
rgb_img = cv2.merge([r,g,b])     # switch it to rgb
# Denoising
dst = cv2.fastNlMeansDenoisingColored(img,None,10,10,7,21)
b,g,r = cv2.split(dst)           # get b,g,r
rgb_dst = cv2.merge([r,g,b])     # switch it to rgb
img_grey = cv2.cvtColor(dst, cv2.COLOR_BGR2GRAY) #GRAYSCALE
img_thr = cv2.adaptiveThreshold(img_grey,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,cv2.THRESH_BINARY,11,2)
cv2.imwrite(path_archive + '//thresh.tif',img_thr)
thresh = Image.open(path_archive + '//thresh.tif')


with open(path_config_file, 'r') as f:
    mycsv = csv.reader(f, delimiter="~")
    mycsv = list(mycsv)
    row = len(mycsv)
    #print (row)
    for line_number in range(1,row):
        area = (mycsv[line_number][1] , mycsv[line_number][4] , mycsv[line_number][3],mycsv[line_number][2])
        img_cropped = thresh.crop([int(y) for y in area])
        img_cropped.save(path_temp+'img_cropped.png')
        #print ("jewk")
        if(mycsv[line_number][5] == "digits"):
            text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq',config='digits')
        elif(mycsv[line_number][5]=="string"):
            text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq',config='strings')
        elif(mycsv[line_number][5]=="date"):
            text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq',config='date')
        elif(mycsv[line_number][5]=="mail"):
            text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq',config='mail')
        else:
            text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq')
        #if(text==""):
        #    text = pytesseract.image_to_string(Image.open(path_temp+ "img_cropped.png"),lang='qqq',config='--psm 7')
        fs = open(path_temp + 'value.csv', 'a')
        fs.write(text + '~')
        fs.close()

#os.system("C://xampp//htdocs//UI//OCR_13//code//edit.php")