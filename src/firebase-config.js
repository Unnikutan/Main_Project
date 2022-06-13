// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyD2Dp2ck9FD-WK0fiS_9GeqmK5c9OJRm9s",
  authDomain: "garbage-ade74.firebaseapp.com",
  projectId: "garbage-ade74",
  storageBucket: "garbage-ade74.appspot.com",
  messagingSenderId: "912267337205",
  appId: "1:912267337205:web:0ea22d521d2d7c157b94bc"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

export const db = getFirestore(app);