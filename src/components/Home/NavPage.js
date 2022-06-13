import React, { useState,useEffect } from 'react'
import { Navbar, Container, Nav, Dropdown, Button,Offcanvas, NavDropdown} from 'react-bootstrap'
// import DropdownToggle from 'react-bootstrap/esm/DropdownToggle';

function NavPage() {
  const [nav_bg,setNavBg] = useState(false);

  const showButton = () => {
    if (window.innerWidth <= 960){
        setNavBg(false);
    } else{
        setNavBg(true);
    }
};

useEffect(()=>{
    showButton();
},[]);

window.addEventListener('resize',showButton);

  return (
    <>  
  <Navbar 
    bg="primary" 
    expand="lg"
  >
    <Container>
      <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
      {nav_bg ? 
          <Nav className="home_nav_right_content">
          <Button className='home_nav_item'>Home</Button>{' '}
          <Button className='home_nav_item'>Locate Bin</Button>{' '}
          <Button className='home_nav_item'>About</Button>{' '}
          <Dropdown>
            <Dropdown.Toggle id="dropdown-basic" className ="home_nav_dropdown">
              Login
            </Dropdown.Toggle>

            <Dropdown.Menu>
              <Dropdown.Item href="/login">User</Dropdown.Item>
              <Dropdown.Item href="/login">Driver</Dropdown.Item>
              <Dropdown.Item href="/login">WM</Dropdown.Item>
            </Dropdown.Menu>
          </Dropdown>
        </Nav>
      :
      <>
      <Navbar.Toggle aria-controls={`offcanvasNavbar-expand-md`} />
        <Navbar.Offcanvas
          id={`offcanvasNavbar-expand-md`}
          aria-labelledby={`offcanvasNavbarLabel-expand-md`}
          placement="end"
        >
          <Offcanvas.Header closeButton>
            <Offcanvas.Title id={`offcanvasNavbarLabel-expand-md`}>
              Menu
            </Offcanvas.Title>
          </Offcanvas.Header>
          <Offcanvas.Body>
            <Nav className="justify-content-end flex-grow-1 pe-3">
              <Nav.Link href="/">Home</Nav.Link>
              <Nav.Link href="/">Locate Bin</Nav.Link>
              <Nav.Link href="#">About</Nav.Link>
              <NavDropdown
                title="Login"
                id={`offcanvasNavbarDropdown-expand-md`}
              >
                <NavDropdown.Item href="/login">User</NavDropdown.Item>
                <NavDropdown.Item href="#action4">
                  Another action
                </NavDropdown.Item>
                <NavDropdown.Item href="#action5">
                  Something else here
                </NavDropdown.Item>
              </NavDropdown>
            </Nav>
          </Offcanvas.Body>
        </Navbar.Offcanvas>
      </>
      }
    </Container>
  </Navbar>
    </>
  )
}

export default NavPage
