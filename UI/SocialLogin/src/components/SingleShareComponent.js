import React from "react";
import ShareButton from "./icons/ShareIcon";
import LoveButton from "./icons/LoveIconComponent";
import CommentButton from "./icons/CommentIcon";
import Button from "react-bootstrap/Button";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import SignUpComponent from "./SignUpComponent";
import CommentComponent from "./CommentComponent";
import ShareContentComponent from "./ShareContentComponent";

const contentAreaStyle = {
  border: "2px solid red",
  marginBottom: "5px",
};

const actionTabStyle = {
  border: "2px solid green",
};
class SingleShareComponent extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isLiked: false,
      isOpen: false,
      isOpenShare: false,
    };
  }

  handleCommentBoxPopUpClose = () => {
    console.log("close");
    this.setState({
      isOpen: false,
    });
  };

  handleCommentsPopUpOpen = () => {
    console.log("opennnn ", this.state.isOpen);

    this.setState({
      isOpen: true,
    });
  };

  handleShareOptionPopUpClose = () => {
    this.setState({
      isOpenShare: false,
    });
  };

  handleShareOptionPopUpOpen = () => {
    console.log("opennnn ", this.state.isOpenShare);
    this.setState({
      isOpenShare: true,
    });
  };

  toggleLikeUnLike = () => {
    this.setState({
      isLiked: !this.state.isLiked,
    });
  };
  render() {
    console.log("aaa ", this.props.uploadName);
    return (
      <div className={"single-share-component " + this.props.uploadName}>
        <div className="content-area" style={contentAreaStyle}>
          <img
            width={"100%"}
            src={require("../resources/" + this.props.uploadName)}
            alt="product"
          ></img>
          &nbsp;
        </div>
        <div class="action-tabs" style={actionTabStyle}>
          <Container fluid>
            <Row>
              <Col>
                <Button
                  style={{ width: "100%" }}
                  onClick={() => this.toggleLikeUnLike()}
                  variant="primary"
                  size="lg"
                >
                  {" "}
                  <LoveButton color={this.state.isLiked ? "red" : "white"} />
                </Button>{" "}
              </Col>
              <Col>
                <Button
                  style={{ width: "100%" }}
                  onClick={() => this.handleCommentsPopUpOpen()}
                  variant="primary"
                  size="lg"
                >
                  {" "}
                  <CommentButton />
                </Button>{" "}
                <CommentComponent
                  handleCommentBoxPopUpClose={this.handleCommentBoxPopUpClose}
                  isOpen={this.state.isOpen}
                />
              </Col>
              <Col>
                <Button
                  onClick={() => this.handleShareOptionPopUpOpen()}
                  style={{ width: "100%" }}
                  variant="primary"
                  size="lg"
                >
                  {" "}
                  <ShareButton />
                </Button>{" "}
                <ShareContentComponent
                  handleShareOptionPopUpClose={this.handleShareOptionPopUpClose}
                  isOpen={this.state.isOpenShare}
                />
              </Col>
            </Row>
          </Container>
        </div>
        <br />
      </div>
    );
  }
}

export default SingleShareComponent;
