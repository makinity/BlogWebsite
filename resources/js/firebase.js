import { initializeApp } from "firebase/app";
import { getFirestore } from "firebase/firestore";

const firebaseConfig = {
  apiKey: "[REDACTED_API_KEY]",
  authDomain: "blogmanagementsystem-17d50.firebaseapp.com",
  projectId: "blogmanagementsystem-17d50",
  storageBucket: "blogmanagementsystem-17d50.firebasestorage.app",
  messagingSenderId: "93548787855",
  appId: "1:93548787855:web:fa16fa23f97dbeffdd98fa",
  databaseURL: "https://blogmanagementsystem-17d50-default-rtdb.firebaseio.com"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

export { db };
