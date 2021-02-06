import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import NavbarComponent from "./components/Navbar";
import LogInSignUpComponents from "./components/LoginSignUpComponent";
import CarouselComponent from "./components/CarouselComponent";
import Alert from "react-bootstrap/Alert";
import FooterTermsComponent from "./components/FooterTerms";
import "react-calendar/dist/Calendar.css";
import HomeScreenComponent from "./components/HomeScreenComponent";
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link,
  Redirect,
} from "react-router-dom";
import UserProfile from "./components/UserProfile";

class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      unAuthorisedMessage: "",
      userName: "",
    };
  }
  getUserCredentials = (userCredentials) => {
    console.log("userCredentials ", userCredentials);
    if (
      userCredentials.userEmail === undefined ||
      userCredentials.userEmail === "" ||
      userCredentials.userPassword === undefined ||
      userCredentials.userPassword === ""
    ) {
      this.setState({
        unAuthorisedMessage: this.getUnAuthorisedMessage(),
      });
    } else {
      this.setState({
        userName: userCredentials.userEmail.substring(
          0,
          userCredentials.userEmail.indexOf("@")
        ),
      });
    }
  };

  // onClickkk = () => {
  //   return <Redirect to="/loginSuccess" />;
  // };

  unSetErrorMessage = () => {
    this.setState({ unAuthorisedMessage: "" })
  }

  getUnAuthorisedMessage = () => {
    return (
      <div
        className="unAuthorised-div"
        style={{
          position: "fixed",
          display: "listItem",
          left: 1000,
          zIndex: 99999,
        }}
      >
        <Alert
          variant="danger"
          onClose={() => this.unSetErrorMessage()}
          dismissible
        >
          <Alert.Heading>Oh snap! You got are NOT authorised!</Alert.Heading>
          <p>please check your userName and password</p>
        </Alert>
      </div>
    );
  };

  render() {
    return (
      <div className="main-parent-div">
        {this.state.unAuthorisedMessage}
        <Router>
          <Switch>
            <Route exact path="/">
              <HomeScreenComponent
                unSetErrorMessage={this.unSetErrorMessage}
                sendCredentialsToApp={this.getUserCredentials}
              />
            </Route>
            <Route
              path={"/login:" + this.state.userName}
              render={() => <UserProfile userHomeName={this.state.userName} />}
              // component={UserProfile}
            ></Route>
          </Switch>
        </Router>
      </div>
    );
  }
}

export default App;

