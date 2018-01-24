import os.path
import os 
from time import gmtime, strftime
import sys
import os
import yaml
import datetime

now = datetime.datetime.now()

#form_type="APP2"
form_type =  sys.argv[1]
y = now.strftime("%d_%m_%Y") +'.csv'
#print (y)

with open("C://xampp//htdocs//UI//OCR_13//path.yaml", 'r') as stream:
    path = yaml.load(stream)
    path_pwd = path['path_pwd']
path_output = path_pwd + '//output'
path_file = path_output + '//' + form_type + '_' + y
path_try2 = path_pwd + '//code//try2.py'
path_append_csv = path_pwd + '//code//append_csv.py' 
if(not(os.path.isfile(path_file))):
    os.system('python ' + path_try2 + ' ' + form_type)
print("")
os.system('python '+ path_append_csv + ' ' + form_type)

