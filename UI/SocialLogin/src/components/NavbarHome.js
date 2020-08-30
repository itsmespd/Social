import React from "react";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import FormControl from "react-bootstrap/FormControl";

class NavbarHomeComponent extends React.Component {
  render() {
    return (
      <Navbar bg="primary" variant="dark">
        <Navbar.Brand href="#home">Social App</Navbar.Brand>
        <Nav className="mr-auto">
          <Nav.Link href="#home">Friends</Nav.Link>
          <Nav.Link href="#features">Photos</Nav.Link>
          <Nav.Link href="#pricing">Sharing</Nav.Link>
        </Nav>
        {/* <Form inline>
                <FormControl type="text" placeholder="Search" className="mr-sm-2" />
                <Button variant="outline-light">Search</Button>
            </Form> */}

        <Form.Label style={{ color: "white", display: "flex" }}>
          Welcome{" "}
          <a style={{ color: "white" }} href="home">
            {" "}
            &nbsp; {this.props.userHomeName.toUpperCase()} &nbsp;
          </a>{" "}
          <div className="log-out">
            <svg
              width="1em"
              height="1em"
              viewBox="0 0 16 16"
              className="bi bi-power"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fillRule="evenodd"
                d="M5.578 4.437a5 5 0 1 0 4.922.044l.5-.866a6 6 0 1 1-5.908-.053l.486.875z"
              />
              <path fillRule="evenodd" d="M7.5 8V1h1v7h-1z" />
            </svg>
          </div>
        </Form.Label>
      </Navbar>
    );
  }
}

export default NavbarHomeComponent;
