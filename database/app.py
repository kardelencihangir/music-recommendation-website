# -*- coding: utf-8 -*-
"""
Created on Sun Mar  8 18:59:04 2020
@author: Bengi
"""


from pandas import DataFrame
import flask
from flask import render_template, request, jsonify , flash, redirect, url_for, session, escape
import json
import numpy as np
import traceback
import pickle
import pandas as pd
from flask import Flask
from wtforms import Form , PasswordField, TextField , validators
from wtforms.validators import DataRequired 
import sqlite3 
from sqlite3 import Error
import database 
import requests



app = Flask(__name__,template_folder='templates')



 
# importing models
with open('model.pkl', 'rb') as f:
   classifier = pickle.load (f)
 
with open('model_columns.pkl', 'rb') as f:
   model_columns = pickle.load (f)
 

@app.route('/')
def welcome():
   return "Machine Learning"

@app.route('/users')
def users():
   return "users"
 
@app.route("/json", methods=["POST"])
def json_example():

    if request.is_json:

        req = request.get_json()

        response_body = {
            "message": "JSON received!",
            "sender": req.get("name")
        }

        res = make_response(jsonify(response_body), 200)

        return res

    else:

        return make_response(jsonify({"message": "Request body must be JSON"}), 400)
    
    
    #kendi admin sayfamı sonra düzenliyebilirim
@app.route('/dashboard', methods=['POST','GET'])
def dashboard():
    return  render_template("dashboard.html")  
    
  
    
#database bağlantısını yapıyorum database.py kodunu çalıstırarak
 
@app.route('/login', methods=['POST','GET'])
def login():
   
       return render_template("login.html")  
       
       

    
    
@app.route('/list', methods=['POST','GET'])
def list():   
      error=None 
      try:   
          
       if flask.request.method == "POST":
           
           
           username = request.form['username']
           #password = request.form['password']

           #sonsuz döngüye girdi burada
           completion = validatetime( username) #, password )
           
           print('completion altındayım bakalım giricek mi')
           if completion ==False:
              error = 'Invalid Credentials. Please try again.'
            
           else :
               with open('songs.json', 'rb') as f:
                  sonngs=json.load(f)
                  completion = sonngs
           
           print('completion codesss' , completion)
           return render_template('list.html', username = completion)
		  
           
          
       
   
      except Exception as e:
        flash(e)
        return  render_template("list.html",error=error)  
    
"""    
class RegistrationForm(Form):    
    username = TextField('Username', [validators.Length(min=4, max=20)])
    email = TextField('Email Address', [validators.Length(min=4, max=40)])
    password = PasswordField('Password', [validators.DataRequired(),validators.EqualTo('confirm', message = "password must match")])
    confirm = PasswordField('Repeat Password')
"""    
    
@app.route('/register')
def register():
   return render_template("register.html")   
 #database bağlantısını yapıyorum database.py kodunu çalıstırarak
#from database import sql_connection  
@app.route('/succesreg', methods=['POST','GET'])
def reg():
    try:
        if request.method == 'POST':
           username = request.form.get('username') 
           email = request.form.get('email')
           password = request.form.get('password')
           #şimdi bunları regdataya göndermek yerine veritabanına kayıt etmeye çalısıcamkayıt işleminde login işlemine bak
           #kayıt işi kolay
           return render_template("regdata.html",password=password,email=email,username=username)

        else:
          return render_template("regdata.html",hata="Formdan veri gelmedi!")
   
    except Exception as e:
        return(str(e))

import Musics as music

    
#database kodlarını sonra databas.py ye taşı 
def validatetime(username):#, password):
    con = sqlite3.connect('database.sqlite')
    completion = False
    with con:
        #hepsini direk çekiyor benim istediğim veri tabanında olanı çeksin sadece
                cur = con.cursor()
                cur.execute("SELECT * FROM triplets_file")
                rows = cur.fetchall()
                for row in rows:
                    dbUser = row[0]
                    #dbPass = row[1]
                    if dbUser==username:
                        #bunu şimdi musics göndermeliyim.o yüzden completionı başka fonks. göndermeli ve oradan çağırmalıyım
                        
                        completion =  music.recsystem(dbUser)
                    
                        #kayıt yoksa false gönderiyor completion ile
    return completion

    
if __name__ == '__main__': 

    user_id = requests.get('http://127.0.0.1:8000/recs').json()
    print(user_id)
    app.run()
    
    #print(Sonuc)