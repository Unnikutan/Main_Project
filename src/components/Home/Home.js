import React from 'react'
import NavPage from './NavPage'
import './Home.css';
import {Carousel, Container, Row, Col, Card, Button} from 'react-bootstrap';

function Home() {
  return (
    <>
        <NavPage />
            
            <Carousel fade>
                <Carousel.Item>
                    <img
                    className="d-block w-100"
                    src="bg_main.jpg"
                    alt="First slide"
                    />
                    <Carousel.Caption className="home_cor_text">
                    <h3>Welcome to Waste Management System</h3>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </Carousel.Caption>
                </Carousel.Item>
                <Carousel.Item>
                    <img
                    className="d-block w-100"
                    src="bg_main.jpg"
                    alt="Second slide"
                    />

                    <Carousel.Caption className="home_cor_text">
                    <h3>Second slide label</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </Carousel.Caption>
                </Carousel.Item>
            </Carousel>

            <h1 className='home_feature_text'>Features</h1>
            <Container fluid="md">
                <Row>
                    <Col md={6} className="home_card_mobile">
                        <Card className='home_icon_loc_1'>
                            <Card.Img variant="top" src="icons/trash.png" className='home_icon_up'/>
                            <Card.Body>
                                <Card.Title className='home_card_title'>Card title</Card.Title>
                                <Card.Text>
                                    This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>

                    <Col md={6} className="home_card_mobile">
                        <Card className='home_icon_loc_2'>
                            <Card.Img variant="top" src="icons/truck.png" className='home_icon_up'/>
                            <Card.Body>
                                <Card.Title className='home_card_title'>Card title</Card.Title>
                                <Card.Text>
                                    This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>
                </Row>
                <Row>
                    <Col md={4} className="home_card_mobile">
                        <Card className='home_icon_loc_3'>
                            <Card.Img variant="top" src="icons/loc.png" className='home_icon'/>
                            <Card.Body>
                                <Card.Title className='home_card_title'>Card title</Card.Title>
                                <Card.Text>
                                    This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>

                    <Col md={4} className="home_card_mobile">
                        <Card className='home_icon_loc_4'>
                            <Card.Img variant="top" src="icons/loc.png" className='home_icon'/>
                            <Card.Body>
                                <Card.Title className='home_card_title'>Card title</Card.Title>
                                <Card.Text>
                                    This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>

                    <Col md={4} className="home_card_mobile">
                        <Card className='home_icon_loc_5'>
                            <Card.Img variant="top" src="icons/loc.png" className='home_icon'/>
                            <Card.Body>
                                <Card.Title className='home_card_title'>Card title</Card.Title>
                                <Card.Text>
                                    This is a longer card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>
                    
                </Row>
            </Container>
            <div className='home_job_con'>
            <Container>
                <Row>
                    <Col md={5}>
                        <img src="job.png" alt="img" className='home_img_job'/>
                    </Col>
                    <Col md={7}>
                        <h3 className='home_job_text_head'>Are you looking forward to work with <span>WM</span>?</h3>
                        <br/>
                        <p className='home_job_text'>Come and join us nowdsadjdsakjbfjsabjkhfb hfjsa fhjkf  jf sakfjshfkjsa fskafsjkaf sakfj fjksafkjsaf sajkfskajf sak fsjkf sajkf safjk safjkfsjkf sakfjgsa fjksgafkjsa fjksgafkjsa</p>
                        <Button variant='outline-dark'>Apply Now</Button>
                    </Col>
                </Row>
            </Container>
            </div>
    </>
  )
}

export default Home
