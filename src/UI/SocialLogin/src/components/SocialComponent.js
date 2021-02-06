import React from "react";
import Card from "react-bootstrap/Card";
import LoveIcon from "./icons/LoveIconComponent";
import ThumbsUpIcon from "./icons/ThumbsUpIcon";
import SingleShareComponent from "./SingleShareComponent";

const styleContent = {
  height: "100%",
  width: "55%",
  marginLeft: "20px",
  marginTop: "10px",
  border: "2px solid black",
};

const imageNameList = ["brothers.jpg", "diversity.jpg", "indianFlag.jpg"];

class SocialComponent extends React.Component {
  render() {
    return (
      <Card style={styleContent}>
        <Card.Body>
          <Card.Title>Here is What your Friends Are Doing</Card.Title>
          <Card.Subtitle className="mb-2 text-muted">
            Like, Comment And Share
          </Card.Subtitle>
          {imageNameList.map((item, index) => {
            return <SingleShareComponent uploadName={item} />;
          })}
        </Card.Body>
      </Card>
    );
  }
}

export default SocialComponent;
