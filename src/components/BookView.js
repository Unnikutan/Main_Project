import { async } from '@firebase/util';
import React, { useEffect, useState } from 'react'
import { Button, Modal, Table } from 'react-bootstrap'
import BookDataServices from '../services/book_services'

function BookView() {
    const [books,setBooks] = useState([]);
    useEffect( () => {
        getBooks();
    }, []);

    const [book_one,setBookOne] = useState([]);

    const getBooks = async () =>{
        const data = await BookDataServices.getAllBooks();
        console.log(data);
        setBooks(data.docs.map((docs)=> ({...docs.data(),id:docs.id})))
    }

    const deleteHandler = async(id) =>{
        await BookDataServices.deleteBook(id);
        getBooks();
    }


    const [show, setShow] = useState(false);
    const handleClose = () => setShow(false);

    const handleShow = async(id) =>{
            try{
                console.log(id);
                const docSnap = await BookDataServices.getBook(id);
                console.log(docSnap.data());
                setBookOne(docSnap.data());
            } 
            catch{
                setBookOne("");
            }
            setShow(true);
        }
        
  return (
    <>
        <div className='mb-2'>
            <Button variant='secondary' onClick={getBooks}>Refresh</Button>
        </div>
        <Table striped bordered hover size='sm'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Book Author</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {books.map((docs, index) => {
                    return(
                        <>
                        <tr key={docs.id}>
                            <td>{index+1}</td>
                            <td>{docs.title}</td>
                            <td>{docs.author}</td>
                            <td>{docs.status}</td>
                            <td><Button variant='outline-secondary' onClick={(e)=> handleShow(docs.id)}>Edit</Button>
                            <Button variant='outline-danger' onClick={(e)=> deleteHandler(docs.id)}>Delete</Button> </td>
                        </tr>
                        </>
                    )
                })}
                
                <Modal show={show} onHide={handleClose}>
                    <Modal.Header closeButton>
                        <Modal.Title>Edit Changes</Modal.Title>
                    </Modal.Header>
                    <Modal.Body>{book_one.title}</Modal.Body>
                    <Modal.Footer>
                        <Button variant="secondary" onClick={handleClose}>
                        Close
                        </Button>
                        <Button variant="primary" onClick={handleClose}>
                        Save Changes
                        </Button>
                    </Modal.Footer>
                </Modal>

                
            </tbody>

        </Table>
    
    </>
  )
}

export default BookView
