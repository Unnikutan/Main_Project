import { async } from '@firebase/util';
import React, { useState } from 'react'
import BookDataServices from '../services/book_services'
import { Container, Nav, Navbar} from 'react-bootstrap';
import { Form, Button, Row, Col } from 'react-bootstrap';
import "./style.css";
import { Alert } from 'react-bootstrap';
import BookView from './BookView';


function LoginAction() {
  const [title, setTitle] = useState("");
  const [author, setAuthor] =  useState("");
  const [status, setStatus] = useState("");
  const [message,setMessage] = useState({error:false, msg:""});

  const handleSubmit = async (e) => {
    e.preventDefault();
    setMessage("");
    if (title === "" || author === ""){
      setMessage({error: true, msg: "All fields are Mandatory"});
      return;
    }
    const newBook = {
      title,
      author,
      status
    }

    console.log(newBook);

    try{
      await BookDataServices.addBooks(newBook);
      setMessage({error:false, msg: "Book added Succesfully" })
    } catch(err){
      setMessage({error:true, msg: err.message})
    }
    setTitle("");
    setAuthor("");
}

  return (
    <>
      <Container>
        <Navbar expand="lg" variant="light" bg="light">
          <Container>
            <Navbar.Brand className='login_block'>
              <div className='login_align_center'> Firebase Connection </div>
            </Navbar.Brand>
          </Container>
        </Navbar>
      </Container> 

      <Container>
        <Form className='login_blk' onSubmit={handleSubmit}>
        {message.msg && (
          <Alert variant={ message?.error ? "danger":"success"} dismissible onClose={() => setMessage("")}>{message.msg}</Alert>
        )}
          <Form.Group as={Row} className="mb-3" controlId="formHorizontalBookTitle">
            <Form.Label column sm={2}>
              Book Title
            </Form.Label>
            <Col sm={10}>
              <Form.Control 
                type="text" 
                placeholder="title" 
                value={title} 
                onChange={(e) => setTitle(e.target.value)}
                />
            </Col>
          </Form.Group>

          <Form.Group as={Row} className="mb-3" controlId="formHorizontalAuthor">
            <Form.Label column sm={2}>
              Author
            </Form.Label>
            <Col sm={10}>
              <Form.Control 
              type="text" 
              placeholder="author" 
              value={author} 
              onChange={(e) => setAuthor(e.target.value)}
              />
            </Col>
          </Form.Group >
          <Button 
            variant="success"
            onClick={()=> setStatus("Available")} 
          >Available</Button>
          <Button 
            variant="danger"
            onClick={()=> setStatus("Not Available")}
            >Not Available</Button>
          <br />
          <p className='login_align_center'>
          <br />
          <Button variant="primary" type="submit">
            Submit
          </Button>
          </p>
        </Form>
        <BookView /> 
      </Container>

    </>
  )
}

export default LoginAction