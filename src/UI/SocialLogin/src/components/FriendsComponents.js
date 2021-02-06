import React from "react";
import Card from "react-bootstrap/Card";
import SingleFriendComponent from "./SingleFriendComponent";
import FriendRequestComponent from "./FriendRequestComponent";
import Form from "react-bootstrap/Form";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";

const styleContent = {
  height: "100%",
  width: "20%",
  marginLeft: "20px",
  marginTop: "10px",
  backgroundColor: "#45f74e",
  border: "2px solid black",
};

class FriendComponent extends React.Component {
  render() {
    return (
      <Card style={styleContent}>
        <Card.Header>Friends Online</Card.Header>
        <Card.Body>
          {this.props.userData.friendList.map((item, index) => {
            return <SingleFriendComponent index={index} item={item} />;
          })}
        </Card.Body>
        <Card.Header>Friends Requests</Card.Header>
        <Card.Body>
          {this.props.userData.friendRequest.map((item, index) => {
            return <FriendRequestComponent index={index} item={item} />;
          })}{" "}
        </Card.Body>
      </Card>
    );
  }
}

export default FriendComponent;
