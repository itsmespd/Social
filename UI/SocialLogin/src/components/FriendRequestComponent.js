import React from "react";
import Avatar from "react-avatar";
import Alert from "react-bootstrap/Alert";
import { BrowserRouter as Router, Route, Link, Switch } from 'react-router-dom'; 
import ProfileComponent from './ProfileComponent';


class FriendRequestComponent extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      renderComponent:""
    };
  }
  
  onClickChangeRender=(item)=>{
    this.setState({
      renderComponent:<ProfileComponent item={item}/>
    })
  }

  render() {
    return (
      <div className="friend-request-main-div">
        <Alert
          key={this.props.index}
          variant={"light"}
          style={{ display: "flex", marginTop: "10px" }}
        >
          {" "}
          <Router>
          <Link onClick={()=>this.onClickChangeRender(this.props.item)} to={"/profile:"+this.props.item.firstName + this.props.item.lastName}>
          <Avatar
            textSizeRatio={1.75}
            name={this.props.item.firstName + " " + this.props.item.lastName}
            size="30"
            round={true}
          />{" "}
          <h6 style={{ paddingTop: "5px", paddingLeft: "5px" }}>
            {this.props.item.firstName}
          </h6>{" "}
          </Link>
          <Switch> 
            {/* <Route path="/" component={App}> */}
              <Route  path={"/profile:"+this.props.item.firstName + this.props.item.lastName} 
              component={()=><ProfileComponent item={this.props.item}/>}/>
            {/* </Route> */}
              {/* <Route  path='/about' component={()=><h6>AAAA</h6>}></Route> 
              <Route exact path='/contact' component={()=> <h6>BBBB</h6>}></Route>  */}
            </Switch>
          <div
            className="chat-video-icons"
            style={{ display: "flex", position: "absolute", left: "175px" }}
          >
            <div className="accept-icon" type="button">
              <svg
              color="green"
                width="20px"
                height="20px"
                viewBox="0 0 16 16"
                class="bi bi-check2-square"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M15.354 2.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L8 9.293l6.646-6.647a.5.5 0 0 1 .708 0z"
                />
                <path
                  fill-rule="evenodd"
                  d="M1.5 13A1.5 1.5 0 0 0 3 14.5h10a1.5 1.5 0 0 0 1.5-1.5V8a.5.5 0 0 0-1 0v5a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 0 0-1H3A1.5 1.5 0 0 0 1.5 3v10z"
                />
              </svg>
            </div>
            <div
              className="reject-icon"
              type="button"
              style={{
                paddingLeft: "5px",
                /* margin-bottom: -27px; */
                marginTop: "-2px",
              }}
            >
              <svg
                color="red"
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                className="bi bi-x-square-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fillRule="evenodd"
                  d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm9.854 4.854a.5.5 0 0 0-.708-.708L8 7.293 4.854 4.146a.5.5 0 1 0-.708.708L7.293 8l-3.147 3.146a.5.5 0 0 0 .708.708L8 8.707l3.146 3.147a.5.5 0 0 0 .708-.708L8.707 8l3.147-3.146z"
                />
              </svg>
            </div>
          </div>
          </Router>
        </Alert>
      </div>
    );
  }
}

export default FriendRequestComponent;
