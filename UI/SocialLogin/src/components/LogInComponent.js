import React, { Component } from "react";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";
import SignUpComponent from "./SignUpComponent";
import { Link } from "react-router-dom";

class LogInComponent extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isOpen: false,
      redirectLink: "",
      errorMap: {
        isEmailError: false,
        isPasswordError: false,
      },
      allUserList: [
        {
          userEmail: "spd@gmail.com",
          userPassword: "pandeyJi",
        },
        {
          userEmail: "srk@gmail.com",
          userPassword: "khanSahab",
        },
      ],
    };
  }

  handleSignInPopUpOpen = () => {
    this.setState({
      isOpen: true,
    });
  };

  handleSignInPopUpClose = () => {
    this.setState({
      isOpen: false,
    });
  };

  storeUserCredentials = (event) => {
    this.props.unSetErrorMessage();
    this.setState({
      errorMap: { isEmailError: false, isPasswordError: false },
      [event.target.name]: event.target.value,
    });
  };

  isValidUser = () => {
    if (
      this.state.email === undefined ||
      this.state.email === "" ||
      this.state.password === undefined ||
      this.state.password === ""
    ) {
      let existingMap = this.state.errorMap;
      if (this.state.email === undefined || this.state.email === "") {
        existingMap.isEmailError = false;
      }
      if (this.state.password === undefined || this.state.password === "") {
        existingMap.isPasswordError = false;
      }
    } else {
      let isUserAuthorised = false;
      this.state.allUserList.forEach((item) => {
        if (
          item.userEmail === this.state.email &&
          item.userPassword === this.state.password
        ) {
          isUserAuthorised = true;
        }
      });
      return isUserAuthorised;
    }
  };

  sendCredentialsToApp = () => {
    if (this.isValidUser() !== undefined && this.isValidUser() === true) {
      this.setState({
        redirectLink:
          "/login:" +
          this.state.email.substring(0, this.state.email.indexOf("@")),
      });
      this.props.sendCredentialsToApp({
        userEmail: this.state.email,
        userPassword: this.state.password,
      });
      document.getElementById("logIn-button").click();
    } else {
      this.props.sendCredentialsToApp({
        userEmail: undefined,
        userPassword: undefined,
      });
    }
  };

  render() {
    return (
      <Form>
        <Form.Label column="lg" style={{ display: "inline-flex" }}>
          <h3 style={{ color: "#f57b42" }}>Sign</h3>
          &nbsp;
          <h3 style={{ color: "#31e834" }}>In</h3>
        </Form.Label>
        <Form.Group controlId="formBasicEmail">
          <Form.Label>Email address</Form.Label>
          <Form.Control
            size="lg"
            type="email"
            onChange={(e) => this.storeUserCredentials(e)}
            name="email"
            placeholder="Enter email"
            isValid={this.state.errorMap.isEmailError}
          />
          <Form.Text className="text-muted">
            We'll never share your email with anyone else.
          </Form.Text>
        </Form.Group>
        <Form.Group controlId="formBasicPassword">
          <Form.Label>Password</Form.Label>
          <Form.Control
            size="lg"
            name="password"
            onChange={(e) => this.storeUserCredentials(e)}
            type="password"
            placeholder="Password"
            isValid={this.state.errorMap.isPasswordError}
          />
        </Form.Group>
        <Form.Group controlId="formBasicCheckbox">
          <Form.Check type="checkbox" label="Keep me signed In" />
        </Form.Group>
        <Link to={this.state.redirectLink}>
          <Button
            variant="primary"
            id="logIn-button"
            onClick={this.sendCredentialsToApp}
          >
            Log In
          </Button>
        </Link>
        &nbsp; &nbsp;
        <Button variant="primary" onClick={() => this.handleSignInPopUpOpen()}>
          Sign Up
        </Button>
        <SignUpComponent
          handleSignInPopUpClose={this.handleSignInPopUpClose}
          isOpen={this.state.isOpen}
        />
      </Form>
    );
  }
}

export default LogInComponent;
