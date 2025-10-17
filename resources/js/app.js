import './bootstrap';
import { db } from "./firebase";
import { collection, addDoc, onSnapshot } from "firebase/firestore";

// Send a message
async function sendMessage(sender, receiver, message) {
    await addDoc(collection(db, "chats"), {
        sender,
        receiver,
        message,
        timestamp: Date.now(),
    });
}

// Listen for new messages
onSnapshot(collection(db, "chats"), (snapshot) => {
    snapshot.docChanges().forEach((change) => {
        if (change.type === "added") {
            console.log("New message:", change.doc.data());
        }
    });
});

// Example test
sendMessage("user1", "user2", "Hello from Firebase + Laravel!");
