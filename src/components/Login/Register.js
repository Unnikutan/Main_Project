import React, { useState } from 'react'
import { Button, Col, Container, ProgressBar, Row } from 'react-bootstrap'
import './Login.css';

function Register() {
    const [pr,setPr] = useState(10);
    const [conState,setConState] = useState({one:true,two:false,three:false})
    const moveNext = (e) =>{
        if(e === 1){
            setConState({one:false,two:true,three:false})
            setPr(50);
        }
        if(e === 2){
            setConState({one:false,two:false,three:true})
            setPr(100);
        }
    }

    const movePrev = (e) => {
        if (e === 2){
            setConState({one:true,two:false,three:false})
            setPr(10);
        }
        if(e === 3){
            setConState({one:false,two:true,three:false})
            setPr(50);
        }
    }
  return (
    <>
      <Container className='registration_page_background'>
        <Row>
            <Col className='registration_padding'>
                <h2 className='registration_padding'><u>Registration</u></h2>
                <Col className='reg_progress_col'>
                    <ProgressBar className='reg_progress_bar' now={pr}>
                    </ProgressBar>
                    <div className="reg_progress_bar_1 reg_progress_color">1</div>
                    <div className={conState.two||conState.three ?'reg_progress_bar_2 reg_progress_color':'reg_progress_bar_2'}>2</div>
                    <div className={conState.three ?'reg_progress_bar_3 reg_progress_color':'reg_progress_bar_3'}>3</div>
                </Col>
                <Row className='reg_progress_under_text'>
                    <Col className="reg_align_left">
                        Step1
                    </Col>
                    <Col className="reg_align_center">
                        Step2
                    </Col>
                    <Col className="reg_align_right">
                        Step3
                    </Col>
                </Row>
                <Container className={conState.one ? "register_container_display" : "register_container_no_display"}>
                    <Row className='registration_row'>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='First Name'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Last Name'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Email'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Phone Number'></input>
                        </Col>
                    </Row>
                    <br />
                    <Row>
                        <Col className="reg_align_right">
                            <Button onClick={()=> moveNext(1)} className='reg_btn'>Next</Button>
                        </Col>
                    </Row>
                </Container>
                <Container className={conState.two ? "register_container_display" : "register_container_no_display"}>
                <Row className='registration_row'>
                        <Col lg={12} className="reg_col_image">
                            <label for="profile_pic" className='reg_upload_image'> 
                                <div className='reg_image_upload_text'><br /><br /><br />
                                    <i className='fa-solid fa-pen'></i> 
                                </div>
                            </label>
                            <input type='file' hidden id="profile_pic"></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Last Name'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Email'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Phone Number'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Phone Number'></input>
                        </Col>
                    </Row>
                    <br />
                    <Row>
                        <Col className="reg_align_left">
                            <Button onClick={()=> movePrev(2)}>Prev</Button>
                        </Col>
                        <Col className="reg_align_right">
                            <Button onClick={()=> moveNext(2)}>Next</Button>
                        </Col>
                    </Row>
                </Container>
                <Container className={conState.three ? "register_container_display" : "register_container_no_display"}>
                    <Row className='registration_row'>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Last Name'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Email'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Phone Number'></input>
                        </Col>
                        <Col md={5} className="registration_col">
                            <input type="text" className='reg_input_btn' placeholder='Phone Number'></input>
                        </Col>
                    </Row>
                    <br />
                    <Row>
                        <Col className="reg_align_left">
                            <Button onClick={()=> movePrev(3)}>Prev</Button>
                        </Col>
                        <Col className="reg_align_right">
                            <Button>Register</Button>
                        </Col>
                    </Row>
                </Container>
            </Col>
        </Row>
      </Container>
    </>
  )
}

export default Register
