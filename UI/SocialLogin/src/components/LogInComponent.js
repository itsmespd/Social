import React, { Component } from "react";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import SignUpComponent from './SignUpComponent'

class LogInComponent extends Component {

  constructor(props){
    super(props);
    this.state={
      isOpen:false
    }
  }

  handleSignInPopUpOpen=()=>{
    this.setState({
      isOpen:true
    })
  }

  handleSignInPopUpClose=()=>{
    this.setState({
      isOpen:false
    })
  }

  render() {
    return (
      <Form>
        <Form.Label column="lg" style={{ display: "inline-flex" }}>
          <h3 style={{ color: "#f57b42" }}>Sign</h3>
          &nbsp;
          <h3 style={{ color: "#31e834" }}>
            In
          </h3>
        </Form.Label>
        <Form.Group controlId="formBasicEmail">
          <Form.Label>Email address</Form.Label>
          <Form.Control size="lg" type="email" placeholder="Enter email" />
          <Form.Text className="text-muted">
            We'll never share your email with anyone else.
          </Form.Text>
        </Form.Group>
        <Form.Group controlId="formBasicPassword">
          <Form.Label>Password</Form.Label>
          <Form.Control size="lg" type="password" placeholder="Password" />
        </Form.Group>
        <Form.Group controlId="formBasicCheckbox">
          <Form.Check type="checkbox" label="Keep me signed In" />
        </Form.Group>
        <Button variant="primary" type="submit">
          Log In
        </Button>
        &nbsp; &nbsp;
        <Button variant="primary" onClick={()=>this.handleSignInPopUpOpen()}>
          Sign Up
        </Button>
        <SignUpComponent handleSignInPopUpClose={this.handleSignInPopUpClose} isOpen={this.state.isOpen} />
      </Form>
    );
  }
}

export default LogInComponent;
