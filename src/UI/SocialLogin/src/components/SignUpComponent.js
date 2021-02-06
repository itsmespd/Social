import React, { useState } from "react";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import DatePicker from "react-date-picker";
import postApi from '../api/postApi';
import urlApi from '../config/url';

const defaultErrorMap = {
  isDateError: false,
  isPasswordError: false,
  isEmailError: false,
};

function SignUpComponent(props) {
  const handleClose = () => props.handleSignInPopUpClose();

  if (props.isOpen) {
    //handleShow();
  }

  const [date, setDate] = useState(new Date());

  const [userinfo, setUserInfo] = useState({});

  const [errorMap, setErrorMap] = useState({ ...defaultErrorMap });

  const validateAndHandleDateChange = (inputDate) => {
    var dateDifferenceInYears = diff_years(inputDate, new Date());

    console.log("dateDifferenceInYears ", dateDifferenceInYears);

    if (dateDifferenceInYears < 10) {
      setErrorMap({
        ...errorMap,
        isDateError: true,
      });
    } else {
      setErrorMap({
        ...errorMap,
        isDateError: false,
      });
    }
    console.log("erroMap ", errorMap);
    setDate(inputDate);

    // debugger;
    let dd = inputDate.getDate();
    let mm = inputDate.getMonth() + 1;
    let yyyy = inputDate.getFullYear();
    mm < 10 ? (mm = "0" + mm) : (mm = "" + mm);
    dd < 10 ? (dd = "0" + dd) : (dd = "" + dd);
    setDetailsOnChange("date", dd + "/" + mm + "/" + yyyy);
  };

  const diff_years = (dt2, dt1) => {
    var diff = (dt2.getTime() - dt1.getTime()) / 1000;
    diff /= 60 * 60 * 24;
    return Math.abs(Math.round(diff / 365.25));
  };

  const setDetailsOnChange = (event, date) => {
    event === "date"
      ? setUserInfo({ ...userinfo, dob: date })
      : setUserInfo({ ...userinfo, [event.target.name]: event.target.value });
  };

  const onSubmit = () => {
    console.log("USER DETAILS ", userinfo);
    //making a post call with userinfo as payLoad
    postApi(urlApi.registerURL, userinfo);
    handleClose();
  };

  return (
    <Modal
      size="lg"
      aria-labelledby="contained-modal-title-vcenter"
      centered
      show={props.isOpen === true}
      onHide={handleClose}
      backdrop="static"
      keyboard={false}
    >
      <Modal.Header closeButton>
        <Modal.Title style={{ display: "inline-flex" }}>
          <h3 style={{ color: "#f57b42" }}>Create</h3>
          &nbsp;
          <h3 style={{ color: "#31e834" }}>Account</h3>
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <Container fluid>
          <Form>
            <Row>
              <Col xs={6}>
                <Form.Group controlId="formFirstName">
                  <Form.Label>First Name</Form.Label>
                  <Form.Control
                    type="Text"
                    name="firstName"
                    onChange={(event) => setDetailsOnChange(event)}
                    placeholder="Enter First Name"
                  />
                </Form.Group>
              </Col>
              <Col xs={6}>
                <Form.Group controlId="formLastName">
                  <Form.Label>Last Name</Form.Label>
                  <Form.Control
                    type="Text"
                    name="lastName"
                    onChange={(event) => setDetailsOnChange(event)}
                    placeholder="Enter Last Name"
                  />
                </Form.Group>
              </Col>
            </Row>
            <Row>
              <Col xs={6}>
                <Form.Group controlId="formAge">
                  <Form.Label>Date Of Birth</Form.Label> <br />
                  <DatePicker
                    onChange={validateAndHandleDateChange}
                    value={date}
                    clearIcon={null}
                  />
                  {errorMap.isDateError ? (
                    <Form.Text className="text-muted">
                      <h6 style={{ color: "red" }}>
                        Your Age in less than 10 Years
                      </h6>
                    </Form.Text>
                  ) : new Date(date).getDate() !== new Date().getDate() ? (
                    <Form.Text className="text-muted">
                      <h6 style={{ color: "green" }}>Cool.. Go Ahead</h6>
                    </Form.Text>
                  ) : null}
                </Form.Group>
              </Col>
              <Col xs={6}>
                <Form.Group controlId="formGender">
                  <Form.Label>Gender</Form.Label>
                  <Form.Control
                    as="select"
                    name="gender"
                    onChange={(event) => setDetailsOnChange(event)}
                    defaultValue="Choose..."
                  >
                    {["Female", "Male", "Trans"].map((item) => {
                      return <option>{item}</option>;
                    })}
                  </Form.Control>
                </Form.Group>
              </Col>
            </Row>
            <Form.Group controlId="formGroupEmail">
              <Form.Label>Email address</Form.Label>
              <Form.Control
                type="email"
                name="email"
                onChange={(event) => setDetailsOnChange(event)}
                placeholder="Enter email"
              />
            </Form.Group>
            <Form.Group controlId="formGroupPassword">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password"
                name="password"
                onChange={(event) => setDetailsOnChange(event)}
                placeholder="Password"
              />
            </Form.Group>
            <Form.Group controlId="formGroupConfirmPassword">
              <Form.Label>Confirm Password</Form.Label>
              <Form.Control
                type="password"
                name="confirmPassword"
                onChange={(event) => setDetailsOnChange(event)}
                placeholder="Re-Type Password"
              />
            </Form.Group>
          </Form>
        </Container>
      </Modal.Body>
      <Modal.Footer>
        <Button variant="primary" onClick={() => onSubmit()}>
          Create
        </Button>
        <Button variant="secondary" onClick={handleClose}>
          Close
        </Button>
      </Modal.Footer>
    </Modal>
  );
}

export default SignUpComponent;
