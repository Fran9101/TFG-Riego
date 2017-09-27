#!/usr/bin/python
#-*- coding: UTF-8 -*-
 
import MySQLdb
import serial
import time

#Inicia la comunicaci�n con el puerto serie
PuertoSerie = serial.Serial(port='/dev/ttyACM0', baudrate=9600,timeout=5.0)
var = 'L'
#var = raw_input("escribe un comando: ")
PuertoSerie.write(var)
time.sleep(0.1)
#Lectura de datos
sArduino = PuertoSerie.readline().strip()
#Separa la cadena en valores, cada valor hasta la coma es almacenado en una variable(modificar)
print(sArduino)
sTempAmbiente,sHumAmbiente,sLitros,sId=sArduino.split(',')
ta = float(sTempAmbiente)
ha = float(sHumAmbiente)
li = float(sLitros)
zona = sId
PuertoSerie.close()
# Establecemos la conexi�n con la base de datos
#bd = MySQLdb.connect("host","user","pass","db" )
bd = MySQLdb.connect(host='127.0.0.1',user='root',passwd='Admin',db='ardureg')
# Preparamos el cursor que nos va a ayudar a realizar las operaciones con la base de datos
cursor = bd.cursor()
#Almacenamos los valores en tabla datos de la base
sql='INSERT INTO estadisticas(Fecha,Temperatura,Hum_Aire,Litros,Arduino_IDArduino) VALUES (now(),"%f","%f","%f","%s");' % (ta,ha,li,zona)

print (sql)
try:
   	# Ejecutamos el comando
	cursor.execute(sql)
	bd.commit()
	print "exito!"
except:
	print "Error"
	bd.rollback()
# Nos desconectamos de la base de datos
bd.close()
#este código es el mismo para los demos puerto solo hay que cambiar de ttyACM0 a ttyACM1, ttyACM2, etc...