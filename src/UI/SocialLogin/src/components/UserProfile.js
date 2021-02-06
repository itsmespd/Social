import React from 'react';
import NavbarComponent from './NavbarHome';
// import 'bootstrap/dist/css/bootstrap.min.css';
import ShareComponent from './ShareComponent'
import FriendComponent from './FriendsComponents'
import SocialComponent from './SocialComponent';
import userData from '../resources/friendHomeData.json';

class UserProfile extends React.Component {
  render() {
    return (
      <div className="main-div-home">
        <NavbarComponent userData={userData} userHomeName={this.props.userHomeName}/>
        <div className="share-and-friend-container" style={{display:"flex"}}>
        <ShareComponent userData={userData}/>
        <SocialComponent userData={userData}/>
        <FriendComponent userData={userData}/>
        </div>
      </div>
    )

  }
}

export default UserProfile;
