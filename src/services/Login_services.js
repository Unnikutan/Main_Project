import { collection, getDocs, getDoc, query, where } from "firebase/firestore";
import { db } from "../firebase-config";

const userLoginRef = collection(db,"user");


class LoginService{
    checkUser = (email,pass)=>{
        console.log(email,pass);
        const q = query(collection(db,"user"), where("email","==",email) && where("pass","==",pass));
        return getDocs(q);
    }
}

export default new LoginService