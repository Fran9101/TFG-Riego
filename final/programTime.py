#!/usr/bin/python
#-*- coding: UTF-8 -*-
 
import MySQLdb
import serial
import time

#Inicia la comunicaci�n con el puerto serie
PuertoSerie = serial.Serial(port='/dev/ttyACM0', baudrate=9600,timeout=5.0)
#enviamos el comando para poner la arduino en hora
var = 'S' + time.strftime("%H:%M:%S-%d/%m/%Y")
PuertoSerie.write(var)
time.sleep(0.1)
#comando para obtener el ID
var2 = 'D'
#var = raw_input("escribe un comando: ")
PuertoSerie.write(var2)
time.sleep(0.1)
#Lectura de datos
byteToRead=PuertoSerie.inWaiting();
sArduino = PuertoSerie.read(byteToRead).strip()
#nos conectamos a la base de datos
bd = MySQLdb.connect(host='127.0.0.1',user='root',passwd='Admin',db='ardureg')
cursor = bd.cursor()
#preparamso la consulta de la programacion de la arduino
sql="SELECT P.Hora_ini, P.Hora_fin FROM arduino AS A, arduino_programacion AS AP, programacion AS P WHERE A.IDArduino='"+sArduino+"' AND A.IDArduino=AP.Arduino_IDArduino AND AP.Programacion_IDProg=P.IDProg;" #% (sArduino)

try:
   	# Ejecutamos el comando
	cursor.execute(sql)
    	resultado=cursor.fetchall()
	print resultado
	for registro in resultado:
		inicio=registro[0]
		fin=registro[1]
		print inicio
		print fin
	print "exito!"
except:
	print "Error"
	
cursor.close()
#comando hora inicio riego
prog="I" + inicio
PuertoSerie.write(prog)
#comando hora fin riego
prog2="F" + fin
PuertoSerie.write(prog2)
#cerramos puerto serie
PuertoSerie.close()
