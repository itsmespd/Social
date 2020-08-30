import React from "react";
import LogInComponents from "./LogInComponent";

class LogInSignUpComponents extends React.Component {
  render() {
    return (
      <div
        style={{
          border: "2px solid black",
          marginRight: "-100px",
          padding: "10px",
          borderRadius: "10px",
        }}
      >
        <LogInComponents
          unSetErrorMessage={this.props.unSetErrorMessage}
          sendCredentialsToApp={this.props.sendCredentialsToApp}
        />
      </div>
    );
  }
}

export default LogInSignUpComponents;
