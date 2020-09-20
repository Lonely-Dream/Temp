# -*- coding: utf-8 -*-
import time
import os
import face_recognition as fr
import numpy as np
import cv2
def face_data2string(face_data):
    string=""
    for i in range(127):
        string=string+str(face_data[i])+","
    string = string+str(face_data[127])
    return string
def string2face_data(string):
    face_data=[]
    temp=string.split(",")
    for item in temp:
        face_data.append(float(item))
    return np.array(face_data)


target = fr.load_image_file("test.jpg")
target_code=fr.face_encodings(target,num_jitters=10)
print("目标图像编码结果:(前30分量){}".format(target_code[0][0:30]))

list_code=[]
for i in range(4):
    tmp=fr.load_image_file("set ("+str(i+1)+").jpg")
    list_code.append(fr.face_encodings(tmp,num_jitters=2)[0])
    print("与【{}】匹配结果:{}".format("set ("+str(i+1)+").jpg",fr.compare_faces(target_code,list_code[i])))


