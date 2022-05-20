curl -X POST -H "Authorization: key=AAAAz5fpOO8:APA91bFq5thmisyjQywU2VRSSoXqCmbzK0eYKDSOvi3wMzqiIY1fC2srqghahHhozZF71K0in7H5QoF0utIDDibVsX62j5urm0gmPHdHqZBBoNqV7cBDs32vl7JFHgP9eIc-uls14FeN" -H "Content-Type: application/json" \
   -d '{
  "data": {
    "notification": {
        "title": "FCM Message",
        "body": "This is an FCM Message",
        "icon":"qr-codes.jpg",
    }
  },
  "to": "dQ2ki68H63o8ppGrqt_B1T:APA91bFXprU-OmUXANj2c00wsKf2WHf_w62w1khsZxUkiUEaiv1fWhUky1uooTPQFiHybODkci1evxO7lF7VD2MFKQzJ2ZPnhZAocS9-hOLszC-84z7KgzeFaoC5KYvSNQNYO99LfGQ2"
}' https://fcm.googleapis.com/fcm/send
