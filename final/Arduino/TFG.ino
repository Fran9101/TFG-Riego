#include <Time.h>
#include <TimeLib.h>
#include <DHT11.h>
//el comando es así-> S13:00:00-14/03/2017
byte horaInicio=10, minutoInicio=10, horaFin=10, minutoFin=10;
char cmdLeido[30]; //buffer para comandos leidos por el puerto serie
byte posicion = 0;
int momentoInicio,momentoFin,momentoAhora;
//String resultado="";
//variables higrometro
const int higroPin = A1;
//int estado;
//----------------------
//variables Lluvia FC_37
const int lluviaPin = A0;
//----------------------
//variables flujo YF-s201
const int caudalPin = 2; // Pin digital para el sensor de flujo YF-S201
int litros_Hora; // Variable que almacena el caudal (L/hora)
volatile int pulsos = 0; // Variable que almacena el número de pulsos
unsigned long tiempoAnterior = 0; // Variable para calcular el tiempo transcurrido 
unsigned long pulsos_Acumulados = 0; // Variable que almacena el número de pulsos acumulados
float litros; // // Variable que almacena el número de litros acumulados
//---------------------------------
//variables relé
const int pinRelay = 8;
//--------------------------------
//variables dht11
const int pinDHT= 9;
DHT11 dht11(pinDHT);
int err;
float temp, hum;
//--------------------------------
//identificador
char id = 'E';
//-------------------------------- 
void setup() {
  //pinMode(13,OUTPUT);
  //digitalWrite(13,LOW);
  // put your setup code here, to run once:
  Serial.begin(9600);//activo serial ¿9600?
   //Serial.setTimeout(1000);//timeout para lectura de comandos
  setTime(13,00,00,14,03,2017);//config incial, se cambia despues
  //pinMode(higroPin, INPUT);
  //----------------------------
  //relé
  pinMode(pinRelay, OUTPUT);
  //-------------------------------
  //dht11
  pinMode(pinDHT, INPUT);
  //-------------------------------
  //configuración identificador
  for(int i=4;i<8;i++ ){
    pinMode(i, INPUT);
    if(digitalRead(i)== HIGH){
      switch(i){
        case 4:
           id='A';
           break;
        case 5:
           id='B';
           break;
        case 6:
           id='C';
           break;
        case 7:
           id='D';
           break;
        default:
           id='E';
           break;
      }
    }
  }
  //Serial.print("Arduino configurada como: ");
  //Serial.print(id);
  //Serial.print("\n");
   //flujo con interrupciones
  pinMode(caudalPin, INPUT_PULLUP); // Pin digital como entrada con conexión PULL-UP interna
  interrupts(); // Habilito las interrupciones
  // Interrupción INT0, llama a la ISR llamada "flujo" en cada flanco de subida en el pin digital 2
  attachInterrupt(digitalPinToInterrupt(caudalPin), flujo, RISING);  
  tiempoAnterior = millis(); // Guardo el tiempo que tarda el ejecutarse el setup
  //-------------------------------
}

//función caudalímetro
void caudalFunc()
{
  if(millis() - tiempoAnterior > 1000)
    {
      // Realizo los cálculos
      tiempoAnterior = millis(); // Actualizo el nuevo tiempo
      pulsos_Acumulados += pulsos; // Número de pulsos acumulados
      //litros_Hora = (pulsos * 60 / 7.5); // Q = frecuencia * 60/ 7.5 (L/Hora)
      litros = pulsos_Acumulados*1.0/450; // Cada 450 pulsos son un litro
      pulsos = 0; // Pongo nuevamente el número de pulsos a cero   
    }
}
//funcion para activar o desactivar el relé
void relayFunc(int val)
{
  if(val == 0){
    digitalWrite(pinRelay, LOW);
  }else if(val == 1){
    digitalWrite(pinRelay, HIGH);
  }
}

// Rutina de servicio de la interrupción (ISR)
void flujo() 
{
    pulsos++; // Incrementa en una unidad el número de pulsos
}

boolean esHoraRiego(){
  momentoInicio = (horaInicio*60) + minutoInicio;
  momentoFin = (horaFin*60) + minutoFin;
  momentoAhora = (hour()*60) + minute();
  if((momentoInicio <= momentoAhora) && (momentoAhora < momentoFin)){
    return true;
  }else{
    return false;  
  }
}

void processMsg(){
  //Serial.readBytesUntil('\n',cmdLeido,30);//lee el 
  //digitalWrite(13,HIGH);
  switch(cmdLeido[0]){//leo el tipo de comando
    case 'S':
      //config hora
      setTime((cmdLeido[1]-'0')*10+(cmdLeido[2]-'0'),//horas
              (cmdLeido[4]-'0')*10+(cmdLeido[5]-'0'),//minutos
              (cmdLeido[7]-'0')*10+(cmdLeido[8]-'0'),//segundos
              (cmdLeido[10]-'0')*10+(cmdLeido[11]-'0'),//día
              (cmdLeido[13]-'0')*10+(cmdLeido[14]-'0'),//mes
              (cmdLeido[16]-'0')*1000+(cmdLeido[17]-'0')*100+(cmdLeido[18]-'0')*10+(cmdLeido[19]-'0')//año
        );
       //Serial.print("hora actualizada");
       //Serial.print("\n");
      break;
    case 'I':
      horaInicio = (cmdLeido[1]-'0')*10+(cmdLeido[2]-'0');
      minutoInicio = (cmdLeido[4]-'0')*10+(cmdLeido[5]-'0');
      //Serial.print("hora inicio");
      //Serial.print("\n");
      break;
    case 'F':
      horaFin = (cmdLeido[1]-'0')*10+(cmdLeido[2]-'0');
      minutoFin = (cmdLeido[4]-'0')*10+(cmdLeido[5]-'0');
      //Serial.print("hora fin");
      //Serial.print("\n");
      break;
    case 'L':
      dht11.read(hum, temp);
      //envio por serie los datos
      Serial.print(temp);Serial.print(",");
      Serial.print(hum);Serial.print(",");
      Serial.print(litros);Serial.print(",");
      Serial.println(id);
      //Serial.print(String(temp) + "," + String(hum) + "," + String(litros) + "," + String(id));
      //Serial.println("datos");
      pulsos_Acumulados = 0;
      break;
    case 'D':
      Serial.println(id);
  }
}

void loop() {
  if(Serial.available()>0){
    memset(cmdLeido,0,sizeof(cmdLeido));
    while(Serial.available()>0){
    cmdLeido[posicion]=Serial.read();
    posicion++;
    }
    posicion = 0;
    processMsg();
    //Serial.println("");
  } 
  if(esHoraRiego()){ 
    if((analogRead(higroPin) < 500) || (analogRead(lluviaPin) < 750)){
      relayFunc(0);
    }else{
      relayFunc(1);
    }
    
  }else{
    //se apaga relay
    relayFunc(0);
  }
  caudalFunc();
}

