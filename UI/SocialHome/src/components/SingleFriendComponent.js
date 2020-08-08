import React from "react";
import Avatar from "react-avatar";
import Alert from "react-bootstrap/Alert";

const styleOfDiv = {
  border: "2px solid black",
  borderRadius: "5px",
  backGround: " white",
};
class SingleFriendComponent extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    return (
      <div className="single-friend-main-div">
        <Alert
          key={this.props.index}
          variant={"light"}
          style={{ display: "flex", marginTop: "10px" }}
        >
          {" "}
          <Avatar
            textSizeRatio={1.75}
            name={this.props.item.firstName + " " + this.props.item.lastName}
            size="30"
            round={true}
          />{" "}
          <h6 style={{ paddingTop: "5px", paddingLeft: "5px" }}>
            {this.props.item.firstName}
          </h6>{" "}
          <div
            className="chat-video-icons"
            style={{ display: "flex", position: "absolute", left: "175px" }}
          >
            <div className="chat-icon" type="button">
              <svg
                color="blue"
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                className="bi bi-chat-left-text-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fillRule="evenodd"
                  d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"
                />
              </svg>
            </div>
            <div
              className="video-icon"
              type="button"
              style={{
                paddingLeft: "5px",
                /* margin-bottom: -27px; */
                marginTop: "-2px",
              }}
            >
              <svg
                color="blue"
                width="20"
                height="20"
                viewBox="0 0 16 16"
                className="bi bi-camera-video-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path d="M2.667 3h6.666C10.253 3 11 3.746 11 4.667v6.666c0 .92-.746 1.667-1.667 1.667H2.667C1.747 13 1 12.254 1 11.333V4.667C1 3.747 1.746 3 2.667 3z" />
                <path d="M7.404 8.697l6.363 3.692c.54.313 1.233-.066 1.233-.697V4.308c0-.63-.693-1.01-1.233-.696L7.404 7.304a.802.802 0 0 0 0 1.393z" />
              </svg>
            </div>
          </div>
        </Alert>
      </div>
    );
  }
}

export default SingleFriendComponent;
