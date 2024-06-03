#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecureBearSSL.h>

// Replace with your network credentials
const char* ssid = "Chaenelle";
const char* password = "@Iceangel1011";

String inputString = "";

const int trigPin = 5;
const int echoPin = 4;

const int trigPin2 = 0;
const int echoPin2 = 16;

const int trigPin3 = 14;
const int echoPin3 = 12;

const int trigPin4 = 13;
const int echoPin4 = 15;
String payloadData = "";

void setup() {
  Serial.begin(115200);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  pinMode(trigPin2, OUTPUT);
  pinMode(echoPin2, INPUT);

  pinMode(trigPin3, OUTPUT);
  pinMode(echoPin3, INPUT);

  pinMode(trigPin4, OUTPUT);
  pinMode(echoPin4, INPUT);

  //Connect to Wi-Fi
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi ..");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print('.');
    delay(1000);
  }
}

void loop() {
  inputString = "";
  if ((WiFi.status() == WL_CONNECTED)) {
    Serial.println("Connected");
  }
  
  String d1 = distance1();
  String d2 = distance2();
  String d3 = distance3();
  String d4 = distance4();

  Serial.print("Distance1:");
  Serial.println(d1);
  Serial.print("Distance2:");
  Serial.println(d2);
  Serial.print("Distance3:");
  Serial.println(d3);
  Serial.print("Distance4:");
  Serial.println(d3);

  if ((WiFi.status() == WL_CONNECTED)) {

    std::unique_ptr<BearSSL::WiFiClientSecure>client(new BearSSL::WiFiClientSecure);

    client->setInsecure();
    
    HTTPClient https;
    payloadData = "s1="+d1+"&s2="+d2+"&s3="+d3+"&s4="+d4;
    Serial.print("[HTTPS] begin...\n");
    String urlRequest = "https://drainage.aviarthardph.online/saveSensor?" + payloadData;
    Serial.println(urlRequest);
    if (https.begin(*client, urlRequest)) {  // HTTPS
      Serial.print("[HTTPS] GET...\n");
      int httpCode = https.GET();
      if (httpCode > 0) {
        Serial.printf("[HTTPS] GET... code: %d\n", httpCode);
        payloadData = "";
        if (httpCode == HTTP_CODE_OK) {
          String payload = https.getString();
          Serial.println(payload);
          payloadData = payload;
     
        }
      } else {
        Serial.printf("[HTTPS] GET... failed, error: %s\n", https.errorToString(httpCode).c_str());
      }

      https.end();
    } else {
      Serial.printf("[HTTPS] Unable to connect\n");
    }
    inputString = "";
  }
  delayMicroseconds(10000);
}

String distance1() {
    digitalWrite(trigPin, LOW);
  delayMicroseconds(5);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  long duration = pulseIn(echoPin, HIGH);
  long distance = duration * 0.034 / 2;

  return String(distance);
}

String distance2() {
  
  digitalWrite(trigPin2, LOW);
  delayMicroseconds(5);

  digitalWrite(trigPin2, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin2, LOW);

  long duration = pulseIn(echoPin2, HIGH);
  long distance = duration * 0.034 / 2;

  return String(distance);
}

String distance3() {
  
  digitalWrite(trigPin3, LOW);
  delayMicroseconds(5);

  digitalWrite(trigPin3, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin3, LOW);

  long duration = pulseIn(echoPin3, HIGH);
  long distance = duration * 0.034 / 2;

  return String(distance);
}

String distance4() {
  
  digitalWrite(trigPin4, LOW);
  delayMicroseconds(5);

  digitalWrite(trigPin4, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin4, LOW);

  long duration = pulseIn(echoPin4, HIGH);
  long distance = duration * 0.034 / 2;

  return String(distance);
}
