import { db } from "../firebase-config";
import { 
    collection, 
    getDoc, 
    getDocs, 
    addDoc, 
    updateDoc, 
    deleteDoc, doc
} from "firebase/firestore";

const bookCollectionRef = collection(db,"books");
class BookDataServices{
    addBooks = (newBooks) => {
        return (
            addDoc(bookCollectionRef, newBooks)
        );
    }

    updateBook = (id,updatedBook) => {
        const bookDoc = doc(db,"books",id);
        return updateDoc(bookDoc,updatedBook)
    }

    deleteBook = (id) => {
        const bookDoc = doc(db,"books",id);
        return deleteDoc(bookDoc)
    }

    getAllBooks = () => {
        return getDocs(bookCollectionRef);
    }

    getBook = (id) => {
        const bookDoc = doc(db,"books",id);
        return getDoc(bookDoc);
    }
}

export default new BookDataServices


