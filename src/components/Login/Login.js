import React, { useState } from 'react'
import { Button, Col, Container, Row } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import Login_services from '../../services/Login_services';
import './Login.css'

function Login() {

    const [email,setEmail] = useState("");
    const [password,setPassword] = useState("");
    const [error,setError] = useState("");
    const [user,setUser] = useState([]);
    const [out_Focus,setFocus] = useState(true);
    const [out_Focus_2,setFocus_2] = useState(true);

    const handleLogin = async(e) =>{
        e.preventDefault();
        try{
            const data = await Login_services.checkUser(email,password);
            setUser(data.docs.map((docs)=> ({...docs.data(),id:docs.id})));

            console.log(user);
        }catch{
            
            console.log("Server Down");
        }
    }
  return (
    <>
    <div className='login_bg'></div>
        <form onSubmit={handleLogin}>
        <Container className="login_align_container_center">
            <Row className='login_align_row_center'>
                <Col md={5} className='login_align_col_center'>
                    {error}
                    <h2>Login Page</h2>
                    <br />
                    <div 
                        className={ out_Focus  ? 'login_input_box':'login_input_box_1'} 
                        onClick={()=> setFocus(false)} 
                        onBlur ={()=> setFocus(true)}
                    >
                        <i class="fa-solid fa-envelope"></i>
                        <input 
                            type="email" 
                            className='login_input_type' 
                            placeholder='Email'
                            required = 'yes'
                            value={email}
                            onChange = {(e) => setEmail(e.target.value)}
                        ></input>
                        
                    </div>
                    <div 
                        className={ out_Focus_2  ? 'login_input_box':'login_input_box_1'} 
                        onClick={()=> setFocus_2(false)} 
                        onBlur ={()=> setFocus_2(true)}
                    >    
                        <i class="fa-solid fa-lock"></i>
                        <input 
                            type="password" 
                            className='login_input_type' 
                            placeholder='Password'
                            required
                            value={password}
                            onChange = {(e) => setPassword(e.target.value)}
                        ></input>
                    </div>
                    <Button varient="primary" className='login_btn' type="submit">Login</Button>
                    <br />
                    <div>Or</div>
                    <div className='login_border_bottom'>
                    <Button variant="outline-secondary" >Sign in with Google <i class="fa-brands fa-google"></i></Button>
                    </div>
                    <br />
                    <div className='login_border_bottom'>
                        Doesn't have an account 
                    <Link to="/register"> Register Now</Link>
                    </div>
                </Col>
            </Row>
        </Container>
        </form>
    </>
  )
}

export default Login
