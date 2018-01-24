import csv  
import os
from time import gmtime, strftime
import sys
import yaml
import datetime

now = datetime.datetime.now()
#form_type="APP2"
form_type =  sys.argv[1]
y = now.strftime("%d_%m_%Y") +'.csv'

with open("C://xampp//htdocs//UI//OCR_13//path.yaml", 'r') as stream:
    path = yaml.load(stream)
    path_pwd = path['path_pwd']
    
path_filecsv = path_pwd+'//temp//file.csv'
path_file = path_pwd + '//output//' + form_type +'_' + y

with open(path_filecsv,'r') as csv_file:
    csv_reader = csv.reader(csv_file,delimiter=',')

    with open(path_file, 'a') as f:
        writer = csv.writer(f,delimiter='~')
            
        for line in csv_reader:   
            writer.writerow(line)