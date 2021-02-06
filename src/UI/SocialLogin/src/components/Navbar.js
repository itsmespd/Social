import React from "react";
import Navbar from "react-bootstrap/Navbar";
// import Nav from "react-bootstrap/Nav";
// import Form from "react-bootstrap/Form";
// import Button from "react-bootstrap/Button";
// import FormControl from "react-bootstrap/FormControl";

class NavbarComponent extends React.Component {
  render() {
    return (
        <Navbar fixed="top" bg="primary" variant="dark">
        <Navbar.Brand href="#home">Welcome To IndiaConnect</Navbar.Brand>
        <Navbar.Toggle />
        <Navbar.Collapse className="justify-content-end">
          <Navbar.Text>
            Write/Connect To Us &nbsp;&nbsp;&nbsp; <a href="#connectToUs">Here</a>
          </Navbar.Text>
        </Navbar.Collapse>
      </Navbar>
    );
  }
}

export default NavbarComponent;
