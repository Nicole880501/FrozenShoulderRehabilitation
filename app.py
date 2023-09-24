# =====================================================
# Modified by: Augmented Startups & Geeky Bee AI
# Date : 22 April 2019
# Project: Yoga Angle Corrector/Plank Calc/Body Ratio
# Tutorial: http://augmentedstartups.info/OpenPose-Course-S
# =====================================================
from __future__ import print_function
import os.path
import io
import time
from googleapiclient.discovery import build
from googleapiclient.http import MediaFileUpload, MediaIoBaseDownload
from httplib2 import Http
from oauth2client import file, client, tools

# from flask_restful import Api
from flask import Flask, render_template, Response, request, redirect, url_for
import argparse  # 導入argparse，用於解析和訪問命令列的參數
import logging  # 導入logging模組，用日誌記錄事件和訊息
import time  # 導入time模組
import cv2
# import pymysql
import numpy as np  # (Numerical Python)
import sys  # 導入sys模組，包含和系統有關的參數和函式

from requests import models
# from tensorboard import db

from src.estimator import TfPoseEstimator  # 從tf_pose的 estimator程式引入TfPoseEstimator類別
from src.networks import get_graph_path, model_wh  # 從tf_pose的 networks程式引入get_graph_path函式
import math
import threading
import heapq

global timer
from scipy import stats
import pathlib
# import sys
# import os
# os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'
# import tensorflow as tf

app = Flask(__name__)
# TensorFlow 2 依然支持 TensorFlow 1.X 的 API。為了在 TensorFlow 2 中使用 TensorFlow 1.X 的 API ，我們可以使用 import tensorflow.compat.v1 as tf 導入 TensorFlow，並通過 tf.disable_eager_execution() 禁用默認的即時執行模式。
# tf.disable_eager_execution()

# db = pymysql.connect(host='152.70.81.246', port=33306, user='root', passwd='', db='HBSR', charset='utf8')
# cursor = db.cursor()
# sql: str = "SELECT i_id, i_pw FROM inv"

# 初始化logger物件
# 設定日誌要記錄的模塊(?)為TfPoseEstimator-WebCam
logger = logging.getLogger('TfPoseEstimator-WebCam')

# 級別為debug以上
logger.setLevel(logging.DEBUG)

# 建立一個streamhandler來把日誌印在CMD視窗上，級別為debug以上
ch = logging.StreamHandler()
ch.setLevel(logging.DEBUG)

# 定義最終log資訊的順序,結構和內容為「目前時間 Logger的名字 日誌級別(level) 使用者輸出的訊息」
formatter = logging.Formatter('[%(asctime)s] [%(name)s] [%(levelname)s] %(message)s')
ch.setFormatter(formatter)

# 將相應的handler新增在logger物件中
logger.addHandler(ch)

# def connectDb():
#     try:
#         mysqldb = pymysql.connect(
#             host="152.70.81.246",
#             port=33306,
#             user="root",
#             passwd="880501",
#             db='HBSR',
#             charset='utf8')
#         return mysqldb
#     except Exception as e:
#         logging.error('Fail to connection mysql {}'.format(str(e)))
#     return None
# def selectINV():
#     conn = connectDb()
#     cur = None
#     if conn is not None:
#         cur = conn.cursor()
#     sql = 'select * from INV'
#     if cur is not None:
#         cur.execute(sql)
#         result_one = cur.fetchone()
#         result_many = cur.fetchmany(5) #獲取5筆記錄
#         resultall = cur.fetchall()
#         print('Fetch one row:')
#         print(result_one[1])#數字代表對應column, 由0開始，即0=第一column
#         print('\nFetch many(5) rows:')
#         for row in result_many:
#             print(row[1]) #數字代表column
#
#         print('\nFetch all rows:')
#         for row in resultall:
#             print(row[1]) #數字代表column
#
#
# def insert2db(pose):
#     conn = connectDb()
#     cur = None
#     if conn is not None:
#         cur = conn.cursor()
#     if cur is not None:
#         sql = 'INSERT INTO `record` (`I_ID`, `START_TIME`, `END_TIME`, `MAX_ANGLE`, `POSE`) VALUES (1, \'TOM\', \'LEE\', 25)'
#         cur.execute(sql)
#     conn.commit()




# 將字串中所有大寫字母轉換為小寫後產生的字串後回傳。
def str2bool(v):
    return v.lower() in ("yes", "true", "t", "1")


def find_point(pose, p):
    for point in pose:
        try:
            body_part = point.body_parts[p]
            # print('width: {0}, height: {1}'.format(width, height))
            # print("p: {0}\n x: {1} ({2}px) \n y: {3} ({4}px)".format(p, body_part.x,int(body_part.x * width + 0.5), body_part.y,int(body_part.y * height + 0.5)))
            return (int(body_part.x * width + 0.5), int(body_part.y * height + 0.5))  # 點的位置(單位:像素)
        except:
            return (0, 0)
    return (0, 0)


# 抓節點的垂直地面點
def find_vert(pose, p):
    for point in pose:
        try:
            body_part = point.body_parts[p]
            y = 1
            # print("x: {0}, y: {1}；p: {2}".format(body_part.x, y, p))
            return (int(body_part.x * width + 0.5), int(y * height))
        except:
            return (0, 0)
    return (0, 0)


def euclidian(point1, point2):
    return math.sqrt((point1[0] - point2[0]) ** 2 + (point1[1] - point2[1]) ** 2)


# 內角
def angle_calc(p0, p1, p2):
    '''
        p1 is center point from where we measured angle between p0 and p2
        p1 的對邊對到的角度就是下面angle算的。
    '''
    # [0]:x； [1]:y
    try:
        a = (p1[0] - p0[0]) ** 2 + (p1[1] - p0[1]) ** 2
        b = (p1[0] - p2[0]) ** 2 + (p1[1] - p2[1]) ** 2
        c = (p2[0] - p0[0]) ** 2 + (p2[1] - p0[1]) ** 2
        angle = math.acos((a + b - c) / math.sqrt(4 * a * b)) * 180 / math.pi
    except:
        return 0
    return int(angle)


# 比較座標位置
def compared_angle(sp, ap, cp, pose):
    standard_point = find_point(pose, sp)
    angle_point = find_point(pose, ap)
    compared_point = find_point(pose, cp)
    original = angle_calc(standard_point, angle_point, compared_point)

    if (standard_point[1] > compared_point[1]):
        # print("original", original)
        over_horz_angle = 360 - original
        return int(over_horz_angle)
    else:
        return int(original)


# 抓眾數
def max_mode(a):
    if len(a) > 5:
        max_num = heapq.nlargest(5, a)
        max_mode_num = stats.mode(max_num)[0][0]
        print(max_mode_num)
        # mode_list = []
        # mode_list.append(max_mode_num)
        # print(mode_list)
        # return mode_list
        return max_mode_num


def Mountain_pose(a, b, left, right, pose):
    i = 1
    # distance calculation
    head_hand_dst_l = int(euclidian(find_point(pose, 0), find_point(pose, 7)))  # 頭到左手距離
    head_hand_dst_r = int(euclidian(find_point(pose, 0), find_point(pose, 4)))  # 頭到右手距離
    # print("find_point", find_point(pose, 0), find_point(pose, 7))

    angle5 = compared_angle(1, 5, 6, pose)  # 左手手臂肩膀角度
    angle2 = compared_angle(1, 2, 3, pose)  # 右手手臂肩膀角度
    a.append(angle5)
    b.append(angle2)
    # print('a', a)
    # print('b', b)

    if (head_hand_dst_r in range(70, 175) and head_hand_dst_l in range(70, 175)):  # 標準先比距離
        # print('5:', angle5)`
        # print('2:', angle2)
        if (angle5 >= a[-1] and angle2 >= b[-1]) and angle5 in range(120, 270) and angle2 in range(120, 270):  # 標準再先比角度
            left.append(angle5)
            right.append(angle2)
            # print('left', left)
            # print('right', right)
            return True
    # if mountain_pose(a, b, left, right):
    #     return left, right


def Climb_stair_r(a, right, pose):
    # distance calculation
    # head_hand_dst_l = int(euclidian(find_point(pose, 0), find_point(pose, 7)))  # 頭到左手距離
    head_hand_dst_r = int(euclidian(find_point(pose, 0), find_point(pose, 4)))  # 頭到右手距離

    # angle5 = compared_angle(1, 5, 6)  # 左手手臂肩膀角度
    angle2 = compared_angle(1, 2, 3, pose)  # 右手手臂肩膀角度
    a.append(angle2)

    if (head_hand_dst_r in range(70, 175)):
        # print('2:', angle2)
        if (angle2 >= a[-2] and angle2 in range(120, 270)):
            # print('a', a)
            right.append(angle2)
            return True
        return False


def Climb_stair_l(a, left, pose):
    # distance calculation
    head_hand_dst_l = int(euclidian(find_point(pose, 0), find_point(pose, 7)))  # 頭到左手距離

    angle5 = compared_angle(1, 5, 6, pose)  # 左手手臂肩膀角度
    a.append(angle5)

    if (head_hand_dst_l in range(70, 150)):
        # print('5:', angle5)
        if (angle5 >= a[-2] and angle5 in range(20, 200)):
            # print('a', a)
            left.append(angle5)
            return True
        return False


def backward_extension(a, b, initialize_7, initialize_5, initialize_4, initialize_2, left, right, pose):
    # distance calculation
    head_hand_dst_l = int(euclidian(initialize_7, initialize_5))  # 初始手臂距離
    head_hand_dst_r = int(euclidian(initialize_4, initialize_2))  # 初始手臂距離

    y_left = int(euclidian(initialize_7, find_point(pose, 7)))  # 手臂變動距離
    y_right = int(euclidian(initialize_4, find_point(pose, 4)))  # 手臂變動距離

    if head_hand_dst_l != 0 and head_hand_dst_r != 0 and y_left != 0 and y_right != 0:
        # print('l:', head_hand_dst_l)
        # print('r:', head_hand_dst_r)
        # 後伸角度
        angle_left = int(math.acos((head_hand_dst_l - y_left) / head_hand_dst_l) * 180 / math.pi)
        angle_right = int(math.acos((head_hand_dst_r - y_right) / head_hand_dst_r) * 180 / math.pi)
        # print('angle_left', angle_left)
        # print(f"angle_left: {angle_left}°")
        # print(f"angle_right: {angle_right}°")

        # Error angle calculations
        error_angle_left = angle_calc(find_point(pose, 6), find_point(pose, 5), find_vert(pose, 1))
        error_angle_right = angle_calc(find_point(pose, 3), find_point(pose, 2), find_vert(pose, 1))

        if ((abs(find_point(pose, 7)[0] - initialize_7[0]) <= 50) and (
                abs(find_point(pose, 4)[0] - initialize_4[0]) <= 50)):
            if (angle_left >= a[-1]) or (angle_right >= b[-1]):
                # a.append(angle_left)
                # b.append(angle_right)
                left.append(angle_left)
                right.append(angle_right)
                # print('a', a)
                return True

def draw_str(dst, xxx_todo_changeme, s, color, scale):
    (x, y) = xxx_todo_changeme
    if (color[0] + color[1] + color[2] == 255 * 3):
        cv2.putText(dst, s, (x + 1, y + 1), cv2.FONT_HERSHEY_SIMPLEX, scale, (0, 0, 0), thickness=4, lineType=5)
    else:
        cv2.putText(dst, s, (x + 1, y + 1), cv2.FONT_HERSHEY_SIMPLEX, scale, color, thickness=4, lineType=5)
    # cv2.line
    cv2.putText(dst, s, (x, y), cv2.FONT_HERSHEY_SIMPLEX, scale, (216, 230, 0), lineType=5)

# def job():
#     xxx = 5     # 倒數五秒
#     for i in range(6):
#         print("----------------------Child thread:----------------------", i)
#         time.sleep(1)
#         if i > 5 and i < 11:   # 視窗出現後
#             start = int(time.clock())
#             while True:
#                 # cv2.putText(影像, 文字, 座標, 字型, 大小, 顏色, 線條寬度, 線條種類)
#                 cv2.putText(image, "Countdown: %d second" % xxx, (10, 50), cv2.FONT_HERSHEY_SCRIPT_COMPLEX, 1, color=(0, 0, 255), thickness = 2)
#                 if int(time.clock()) == start + 1:
#                     xxx -= 1
#                     break
#         if xxx == 0:
#             for xx in range(1000):
#                 cv2.putText(image, "It's the final countdown!!", (150, 100), cv2.FONT_HERSHEY_SCRIPT_COMPLEX, 1,
#                             color=(0, 0, 255), thickness=2)




# 權限必須
SCOPES = ['https://spreadsheets.google.com/feeds', 'https://www.googleapis.com/auth/drive']

def delete_drive_service_file(service, file_id):
    service.files().delete(fileId=file_id).execute()

'''
def update_file(service, update_drive_service_name, local_file_path):
    """
    將本地端的檔案傳到雲端上
    :param service: 認證用
    :param update_drive_service_name: 存到 雲端上的名稱
    :param local_file_path: 本地端的位置
    :param local_file_name: 本地端的檔案名稱
    """

    print("正在上傳檔案...")
    file_metadata = {'name': update_drive_service_name}
    media = MediaFileUpload(local_file_path, )
    file_metadata_size = media.size()
    start = time.time()
    file_id = service.files().create(body=file_metadata, media_body=media, fields='id').execute()
    end = time.time()
    url = "https://drive.google.com/file/d/"+str(file_id['id'])+"/view?usp=sharing"
    print("上傳檔案成功！")
    print('雲端檔案名稱為: ' + str(file_metadata['name']))
    print('雲端檔案ID為: ' + str(file_id['id']))
    print('檔案大小為: ' + str(file_metadata_size) + ' byte')
    print("上傳時間為: " + str(end-start))
    print("影片網址："+url)

    return file_metadata['name'], file_id['id']

def search_file(service, update_drive_service_name, is_delete_search_file=False):
    """
    本地端
    取得到雲端名稱，可透過下載時，取得file id 下載
    :param service: 認證用
    :param update_drive_service_name: 要上傳到雲端的名稱
    :param is_delete_search_file: 判斷是否需要刪除這個檔案名稱
    """

    # Call the Drive v3 API
    results = service.files().list(fields="nextPageToken, files(id, name)", spaces='drive',
                                   q="name = '" + update_drive_service_name + "' and trashed = false",
                                   ).execute()

    items = results.get('files', [])
    if not items:
        print('沒有發現你要找尋的 ' + update_drive_service_name + ' 檔案.')
    else:
        print('搜尋的檔案: ')
        for item in items:
            times = 1
            print(u'{0} ({1})'.format(item['name'], item['id']))
            if is_delete_search_file is True:
                print("刪除檔案為:" + u'{0} ({1})'.format(item['name'], item['id']))
                delete_drive_service_file(service, file_id=item['id'])

            if times == len(items):
                return item['id']
            else:
                times += 1


def trashed_file(service, is_delete_trashed_file=False):
    """
    抓取到雲端上垃圾桶內的全部檔案，進行刪除
    :param service: 認證用
    :param is_delete_trashed_file: 是否要刪除垃圾桶資料
    """

    results = service.files().list(fields="nextPageToken, files(id, name)", spaces='drive', q="trashed = true",
                                   ).execute()
    items = results.get('files', [])
    if not items:
        print('垃圾桶無任何資料.')
    else:
        print('垃圾桶檔案: ')

        for item in items:
            print(u'{0} ({1})'.format(item['name'], item['id']))
            if is_delete_trashed_file is True:
                print("刪除檔案為:" + u'{0} ({1})'.format(item['name'], item['id']))
                delete_drive_service_file(service, file_id=item['id'])

def main(is_update_file_function=False, update_drive_service_name=None, update_file_path=None):
    """
    :param is_update_file_function: 判斷是否執行上傳的功能
    :param update_drive_service_name: 要上傳到雲端上的檔案名稱
    :param update_file_path: 要上傳檔案的位置以及名稱
    """

    print("is_update_file_function")
    print(type(is_update_file_function))
    print(is_update_file_function)

    store = file.Storage('token.json')
    creds = store.get()

    if not creds or creds.invalid:
        flow = client.flow_from_clientsecrets('credentials.json', SCOPES)
        creds = tools.run_flow(flow, store)

    service = build('drive', 'v3', http=creds.authorize(Http()))
    print('*' * 10)

    if is_update_file_function is True:
        print(update_file_path + update_drive_service_name)
        print("=====執行上傳檔案=====")

        # 清空 雲端垃圾桶檔案
        # trashed_file(service=service, is_delete_trashed_file=True)

        # 搜尋要上傳的檔案名稱是否有在雲端上並且刪除
        search_file(service=service, update_drive_service_name=update_drive_service_name,
                    is_delete_search_file=True)

        # 檔案上傳到雲端上
        update_file(service=service, update_drive_service_name=update_drive_service_name,
                    local_file_path=os.getcwd() + '/' + update_drive_service_name)

        print("=====上傳檔案完成=====")
'''
# def update_file(service, update_drive_service_name, local_file_path, update_drive_service_folder_id):
#     """
#     將本地端的檔案傳到雲端上
#     :param update_drive_service_folder_id: 判斷是否有 Folder id 沒有的話，會上到雲端的目錄
#     :param service: 認證用
#     :param update_drive_service_name: 存到 雲端上的名稱
#     :param local_file_path: 本地端的位置
#     :param local_file_name: 本地端的檔案名稱
#     """
#
#     print("正在上傳檔案...")
#     if update_drive_service_folder_id is None:
#         file_metadata = {'name': update_drive_service_name}
#     else:
#         print("雲端資料夾id: %s" % update_drive_service_folder_id)
#         file_metadata = {'name': update_drive_service_name,
#                          'parents': update_drive_service_folder_id}
#
#     media = MediaFileUpload(local_file_path, )
#     file_metadata_size = media.size()
#     start = time.time()
#     file_id = service.files().create(body=file_metadata, media_body=media, fields='id').execute()
#     end = time.time()
#
#     print("上傳檔案成功！")
#     print('雲端檔案名稱為: ' + str(file_metadata['name']))
#     print('雲端檔案ID為: ' + str(file_id['id']))
#     print('檔案大小為: ' + str(file_metadata_size) + ' byte')
#     print("上傳時間為: " + str(end-start))
#
#     return file_metadata['name'], file_id['id']


# def search_folder(service, update_drive_folder_name=None):
#     """
#     如果雲端資料夾名稱相同，則只會選擇一個資料夾上傳，請勿取名相同名稱
#     :param service: 認證用
#     :param update_drive_folder_name: 取得指定資料夾的id，沒有的話回傳None，給錯也會回傳None
#     """
#
#     get_folder_id_list = []
#     print(len(get_folder_id_list))
#     if update_drive_folder_name is not None:
#         response = service.files().list(fields="nextPageToken, files(id, name)", spaces='drive',
#                                         q = "name = '" + update_drive_folder_name + "' and mimeType = 'application/vnd.google-apps.folder' and trashed = false").execute()
#
#         for file in response.get('files', []):
#             # Process change
#             print('Found file: %s (%s)' % (file.get('name'), file.get('id')))
#             get_folder_id_list.append(file.get('id'))
#
#         if len(get_folder_id_list) == 0:
#             print("你給的資料夾名稱沒有在你的雲端上！，因此檔案會上傳至雲端根目錄")
#             return None
#         else:
#             return get_folder_id_list
#
#     return None


# def search_file(service, update_drive_service_name, is_delete_search_file=False):
#     """
#     本地端
#     取得到雲端名稱，可透過下載時，取得file id 下載
#     :param service: 認證用
#     :param update_drive_service_name: 要上傳到雲端的名稱
#     :param is_delete_search_file: 判斷是否需要刪除這個檔案名稱
#     """
#
#     # Call the Drive v3 API
#     results = service.files().list(fields="nextPageToken, files(id, name)", spaces='drive',
#                                    q="name = '" + update_drive_service_name + "' and trashed = false",
#                                    ).execute()
#
#     items = results.get('files', [])
#
#     if not items:
#         print('沒有發現你要找尋的 ' + update_drive_service_name + ' 檔案.')
#     else:
#         print('搜尋的檔案: ')
#
#         for item in items:
#             times = 1
#             print(u'{0} ({1})'.format(item['name'], item['id']))
#             if is_delete_search_file is True:
#                 print("刪除檔案為:" + u'{0} ({1})'.format(item['name'], item['id']))
#                 delete_drive_service_file(service, file_id=item['id'])
#             if times == len(items):
#                 return item['id']
#             else:
#                 times += 1


# def trashed_file(service, is_delete_trashed_file=False):
#     """
#     抓取到雲端上垃圾桶內的全部檔案，進行刪除
#     :param service: 認證用
#     :param is_delete_trashed_file: 是否要刪除垃圾桶資料
#     """
#     results = service.files().list(fields="nextPageToken, files(id, name)", spaces='drive', q="trashed = true",
#                                    ).execute()
#     items = results.get('files', [])
#
#     if not items:
#         print('垃圾桶無任何資料.')
#     else:
#         print('垃圾桶檔案: ')
#
#         for item in items:
#             print(u'{0} ({1})'.format(item['name'], item['id']))
#             if is_delete_trashed_file is True:
#                 print("刪除檔案為:" + u'{0} ({1})'.format(item['name'], item['id']))
#                 delete_drive_service_file(service, file_id=item['id'])


# 上傳檔案
# def main(is_update_file_function=False, update_drive_service_folder_name=None, update_drive_service_name=None, update_file_path=None):
#     """
#     :param update_drive_service_folder_name: 給要上傳檔案到雲端的資料夾名稱，預設則是上傳至雲端目錄
#     :param is_update_file_function: 判斷是否執行上傳的功能
#     :param update_drive_service_name: 要上傳到雲端上的檔案名稱
#     :param update_file_path: 要上傳檔案的位置以及名稱
#     """
#
#     print("is_update_file_function: %s" % is_update_file_function)
#     print("update_drive_service_folder_name: %s" % update_drive_service_folder_name)
#     store = file.Storage('token.json')
#     creds = store.get()
#
#     if not creds or creds.invalid:
#         flow = client.flow_from_clientsecrets('credentials.json', SCOPES)
#         creds = tools.run_flow(flow, store)
#
#     service = build('drive', 'v3', http=creds.authorize(Http()))
#     print('*' * 10)
#
#     if is_update_file_function is True:
#         print(update_file_path + update_drive_service_name)
#         print("=====執行上傳檔案=====")
#         # 清空 雲端垃圾桶檔案
#         # trashed_file(service=service, is_delete_trashed_file=True)
#         get_folder_id = search_folder(service = service, update_drive_folder_name = update_drive_service_folder_name)
#
#         # 搜尋要上傳的檔案名稱是否有在雲端上並且刪除
#         search_file(service=service, update_drive_service_name=update_drive_service_name,
#                     is_delete_search_file=True)
#
#         # 檔案上傳到雲端上
#         update_file(service=service, update_drive_service_name=update_drive_service_name,
#                     local_file_path=os.getcwd() + '/' + update_drive_service_name, update_drive_service_folder_id=get_folder_id)
#         print("=====上傳檔案完成=====")

@app.route('/generate')
def generate(mode):
    fps_time = 0
    c = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

    # 建立一個子執行緒
    # counttime = threading.Thread(target=job)

    # 自己執行時，會運作的程式區塊(如果是被引用，就不會跑這部分)
    '''
    parser = argparse.ArgumentParser(description='tf-pose-estimation realtime webcam')
    parser.add_argument('--camera', type=str, default="0")

    parser.add_argument('--resize', type=str, default='432x368',
                        help='if provided, resize images before they are processed. default=0x0, Recommends : 432x368 or 656x368 or 1312x736 ')
    parser.add_argument('--resize-out-ratio', type=float, default=4.0,
                        help='if provided, resize heatmaps before they are post-processed. default=1.0')

    parser.add_argument('--model', type=str, default='mobilenet_thin_432x368',
                        help='cmu / mobilenet_thin / mobilenet_v2_large / mobilenet_v2_small')
    parser.add_argument('--show-process', type=bool, default=False,
                        help='for debug purpose, if enabled, speed for inference is dropped.')

    parser.add_argument('--tensorrt', type=str, default="False",
                        help='for tensorrt process.')
    args = parser.parse_args()
    '''
    print(
        "mode 1: Mountain Pose \nmode 2: Climb Stair (Left) \nmode 3: Climb Stair (Right) \nmode 4: Backward Extention")
    # mode = 1
    print("mode:", mode)
    count = 0

    while True:
        w, h = model_wh('mobilenet_thin_432x368')

        if w > 0 and h > 0:
            e = TfPoseEstimator(get_graph_path('mobilenet_thin_432x368'), target_size=(w, h))
        else:
            e = TfPoseEstimator(get_graph_path('mobilenet_thin_432x368'), target_size=(432, 368))
        # logger.debug('cam read+')

        steam_name = 0

        print(f"Windows正在啟動, {time.ctime()}")

        # if len(args.camera) == 1:
        #     steam_name = int(args.camera)

        cam = cv2.VideoCapture(steam_name)
        # # 使用 XVID 編碼
        # fourcc = cv2.VideoWriter_fourcc(*'XVID')
        # # 建立 VideoWriter 物件，輸出影片至 output.avi
        # # FPS 值為 20.0，解析度為 640x360
        # out = cv2.VideoWriter('output.avi', fourcc, 20.0, (432, 368))
        '''
        ret_val, image = cam.read()
        if not ret_val:
            break
        else:
            ret, buffer = cv2.imencode('.jpg', image)
            image = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + image + b'\r\n')  # concat frame one by one and show result
        # if ret_val == True:
        #     # 寫入影格
        #     out.write(image)
        # logger.info('cam image=%dx%d' % (image.shape[1], image.shape[0]))
        '''
        i = 0
        frm = 0
        y1 = [0, 0]
        a, b, err_left, err_right = [0], [0], [0], [0]
        # modelist_left, modelist_right = [], []
        left, right = [0], [0]

        global height, width

        orange_color = (0, 140, 255)
        # print('AAAAAAAAAAAAAAAAAAAAAAA')
        #############################################################################################################################################################################################
        iid = 'E123456789'
        #############################################################################################################################################################################################
        # counttime.start()
        print(f"開始, {time.ctime()}")
        x = 0
        start = int(time.perf_counter())
        # 第一次
        while True:
            ret_val, image = cam.read()
            i = 1

            # logger.debug('image process+')
            # humans = e.inference(image, resize_to_default=(w > 0 and h > 0), upsample_size=args.resize_out_ratio)
            humans = e.inference(image)
            pose = humans

            # logger.debug('postprocess+')
            image = TfPoseEstimator.draw_humans(image, humans, imgcopy=False)
            height, width = image.shape[0], image.shape[1]

            # logger.debug('show+')
            # 用來顯示畫面左上角fps值
            # cv2.putText(image,
            #             "FPS: %f" % (1.0 / (time.time() - fps_time)),
            #             (10, 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5,
            #             (0, 255, 0), 2)

            # image = cv2.resize(image, (720, 720))
            for i in range(0, 5, 1):
                if (int(time.perf_counter()) == start + i):
                    sec = 4 - i
                    if (sec != 0):
                        cv2.putText(image, " %d..." % sec, (550, 40), cv2.FONT_HERSHEY_SIMPLEX, 1,
                                    color=(0, 0, 255), thickness=2)
                    else:
                        cv2.putText(image, "Go", (550, 40), cv2.FONT_HERSHEY_SIMPLEX, 1,
                                    color=(0, 0, 255), thickness=4)
            if (frm == 0):
                start_time =str(int(time.perf_counter()))
                filename = iid + start_time + '.avi'
                out = cv2.VideoWriter(filename, cv2.VideoWriter_fourcc('M', 'J', 'P', 'G'), 30,
                                      (image.shape[1], image.shape[0]))
                print("Initializing")
                frm += 1

            # cv2.imshow('tf-pose-estimation result', image)
            ret, buffer = cv2.imencode('.jpg', image)
            img = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + img + b'\r\n')  # concat frame one by one and show result

            if i != 0:
                out.write(image)

            fps_time = time.time()
            if cv2.waitKey(1) == 27:
                break
            # logger.debug('finished+')

            # print("x_left:", find_point(pose, 7)[0])
            # print("x_right:", find_point(pose, 4)[0])
            # print("count: ",count)
            # initialize_y_left = find_point(pose, 7)
            # initialize_y_5 = find_point(pose, 5)
            # initialize_y_right = find_point(pose, 4)
            # c.append(initialize_y)
            # print('i__y__left:', initialize_y_left)
            # print('i__y__right:', initialize_y_right)

            if int(time.perf_counter()) == start + 5:
                print("******************************************")
                cv2.destroyAllWindows()
                break

        # counttime.join()

        for i in range(18):
            c[i] = find_point(pose, i)
            print(f"c[{i}] = {c[i]}")

        # ==================================================第二次=========================================================
        time_mountain = int(time.perf_counter())
        while True:
            ret_val, image = cam.read()

            i = 1

            logger.debug('image process+')
            # humans = e.inference(image, resize_to_default=(w > 0 and h > 0), upsample_size=args.resize_out_ratio)
            humans = e.inference(image)
            pose = humans

            logger.debug('postprocess+')
            image = TfPoseEstimator.draw_humans(image, humans, imgcopy=False)
            height, width = image.shape[0], image.shape[1]

            for i in range(0, 30, 1):
                if(int(time.perf_counter()) == time_mountain+i):
                    sec = 30-i
                    cv2.putText(image, " %d" % sec, (550, 40), cv2.FONT_HERSHEY_SIMPLEX, 1,
                                color=(0, 0, 255), thickness=2)
                else:
                    i = i-1
                    cv2.putText(image, " %d" % sec, (550, 40), cv2.FONT_HERSHEY_SIMPLEX, 1,
                                color=(0, 0, 255), thickness=2)
            if mode == 1:
                if len(pose) > 0:
                    if (int(time.perf_counter()) != (time_mountain + 30)):
                        print(a, b, left, right, pose)
                        TF = Mountain_pose(a, b, left, right, pose)
                        if TF == True:
                            # print(left)
                            # print(right)
                            R_angle = max_mode(left)
                            L_angle = max_mode(right)
                            # print(R_angle)
                            # print(L_angle)
                            action = "Mountain Pose"
                            # is_yoga = True
                            draw_str(image, (20, 50), action, orange_color, 2)
                            logger.debug(" ***Mountain Pose*** ")
                    else:
                        cv2.destroyAllWindows()
                        break

                        # count-=1
                        # if(count==0):
                        #     cv2.destroyAllWindows()
                        # print("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%")

            elif mode == 2:
                if len(pose) > 0:
                    if (int(time.perf_counter()) != (time_mountain + 30)):
                        if Climb_stair_l(a, left, pose):
                            action = "Climb Stair (Left)"
                            print(left)
                            L_angle = max_mode(left)
                            # is_yoga = True
                            draw_str(image, (20, 50), action, orange_color, 2)
                            logger.debug(" ***Climb Stair (Left)*** ")

                    else:
                        cv2.destroyAllWindows()
                        break

            elif mode == 3:
                if len(pose) > 0:
                    if (int(time.perf_counter()) != (time_mountain + 30)):
                        if Climb_stair_r(a, right, pose):
                            action = "Climb Stair (Right)"
                            # is_yoga = True
                            print(right)
                            R_angle = max_mode(right)
                            draw_str(image, (20, 50), action, orange_color, 2)
                            logger.debug(" ***Climb Stair (Right)*** ")
                    else:
                        cv2.destroyAllWindows()
                        break

            elif mode == 4:
                if len(pose) > 0:
                    # initialize_y = find_point(pose, 7)
                    if (int(time.perf_counter()) != (time_mountain + 30)):
                        if backward_extension(a, b, c[7], c[5], c[4], c[2], left, right, pose):
                            action = "Backward Extention"
                            # is_yoga = True
                            print(left)
                            print(right)
                            L_angle = max_mode(left)
                            R_angle = max_mode(right)
                            draw_str(image, (20, 50), action, orange_color, 2)
                            logger.debug(" ***Backward Extention*** ")
                    else:
                        cv2.destroyAllWindows()
                        break

            logger.debug('show+')
            # cv2.putText(image,
            #             "FPS: %f" % (1.0 / (time.time() - fps_time)),
            #             (10, 10), cv2.FONT_HERSHEY_SIMPLEX, 0.5,
            #             (0, 255, 0), 2)

            # image = cv2.resize(image, (720, 720))
            if (frm == 0):
                start_time =str(int(time.perf_counter()))
                filename = iid+start_time+'.avi'
                out = cv2.VideoWriter(filename, cv2.VideoWriter_fourcc('M', 'J', 'P', 'G'), 30,
                                      (image.shape[1], image.shape[0]))
                print("Initializing")
                frm += 1

            # cv2.imshow('tf-pose-estimation result', image)
            ret, buffer = cv2.imencode('.jpg', image)
            img = buffer.tobytes()
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + img + b'\r\n')  # concat frame one by one and show result

            if i != 0:
                out.write(image)

            fps_time = time.time()
            if cv2.waitKey(1) == 27:
                break
            logger.debug('finished+')
            # print(c[1])

        cv2.destroyAllWindows()
        main(is_update_file_function=bool(True), update_drive_service_name=filename, update_drive_service_folder_name='video',update_file_path=os.getcwd() + '/')
        break


@app.route('/M_P')
def M_P():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(generate(1), mimetype='multipart/x-mixed-replace; boundary=frame')


@app.route('/climb_l')
def climb_l():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(generate(2), mimetype='multipart/x-mixed-replace; boundary=frame')


@app.route('/climb_r')
def climb_r():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(generate(3), mimetype='multipart/x-mixed-replace; boundary=frame')


@app.route('/BW_E')
def BW_E():
    # Video streaming route. Put this in the src attribute of an img tag
    return Response(generate(4), mimetype='multipart/x-mixed-replace; boundary=frame')


@app.route('/')
def index():
    """Video streaming home page."""
    return render_template('patient/homepage.php')


@app.route('/training')
def training():
    """Video streaming home page."""
    return render_template('patient/training.php')


@app.route('/mountain')
def mountain_pose():
    """Video streaming home page."""
    return render_template('patient/mountain.php')


@app.route('/extension')
def extension():
    """Video streaming home page."""
    return render_template('patient/extension.php')


@app.route('/climb_stair_r')
def climb_stair_r():
    """Video streaming home page."""
    return render_template('patient/R_climbing.php')


@app.route('/climb_stair_l')
def climb_stair_l():
    """Video streaming home page."""
    return render_template('patient/L_climbing.php')


if __name__ == '__main__':
    app.run(debug=True)
