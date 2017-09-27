SELECT A.IDArduino, A.Zona,P.Hora_ini,P.Hora_fin 
FROM arduino AS A, arduino_programacion AS AP, programacion AS P 
WHERE A.IDArduino='A' AND A.IDArduino=AP.Arduino_IDArduino AND AP.Programacion_IDProg=P.IDProg;
/*para mostrar la prog en la web y hacer el update*/
SELECT P.IDProg, A.Zona,P.Hora_ini,P.Hora_fin 
FROM arduino AS A, arduino_programacion AS AP, programacion AS P 
WHERE A.IDArduino=AP.Arduino_IDArduino AND AP.Programacion_IDProg=P.IDProg;
/*para mostrar los id y zona de las arduino*/
SELECT * FROM arduino;
/*update para la programacion*/
UPDATE programacion SET Hora_ini='01:00', Hora_fin='02:00' WHERE IDProg='1';
/*update de las zonas*/
UPDATE arduino SET Zona='Default' WHERE IDArduino='A';
/*consulta por año, mes y dia*/
SELECT * FROM estadisticas WHERE MONTH(Fecha) = 4 AND YEAR(Fecha) = 2017
/*consulta por group*/
SELECT sum(Litros), arduino.Zona  FROM estadisticas INNER JOIN arduino ON estadisticas.Arduino_IDArduino=arduino.IDArduino GROUP BY Arduino_IDArduino;
/*consulta por sector*/
SELECT estadisticas.Fecha, estadisticas.Temperatura, estadisticas.Hum_Aire, estadisticas.Litros, arduino.Zona  
FROM estadisticas INNER JOIN arduino ON estadisticas.Arduino_IDArduino=arduino.IDArduino 
WHERE arduino.Zona='Tomates';