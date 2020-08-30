import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import NavbarComponent from "./Navbar";
import LogInSignUpComponents from "./LoginSignUpComponent";
import CarouselComponent from "./CarouselComponent";
import FooterTermsComponent from "./FooterTerms";
import "react-calendar/dist/Calendar.css";

class HomeScreenComponent extends React.Component {
  render() {
    return (
      <Container fluid className="main-div-container">
        <Row>
          <Col>
            <NavbarComponent />
          </Col>
        </Row>
        <br />
        <br />
        <br />
        <Row>
          <Col xs={5}>
            <CarouselComponent />
          </Col>
          <Col xs={6}>
            <Row>
              <Col>
                <LogInSignUpComponents
                  unSetErrorMessage={this.props.unSetErrorMessage}
                  sendCredentialsToApp={this.props.sendCredentialsToApp}
                />
              </Col>
            </Row>
            <Row>
              <Col>
                <br />
                <div
                  style={{
                    padding: "10px",
                    border: "2px solid red",
                    borderRadius: "10px",
                    marginRight: "-100px",
                  }}
                >
                  <FooterTermsComponent />
                </div>
              </Col>
            </Row>
          </Col>
        </Row>
      </Container>
    );
  }
}

export default HomeScreenComponent;
