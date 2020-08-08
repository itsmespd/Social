import React from 'react';
import NavbarComponent from '../src/components/Navbar'
import 'bootstrap/dist/css/bootstrap.min.css';
import './App.css';
import ShareComponent from './components/ShareComponent'
import FriendComponent from './components/FriendsComponents'
import SocialComponent from './components/SocialComponent';
import userData from './data.json';

class App extends React.Component {
  render() {
    return (
      <div className="main-div">
        <NavbarComponent userData={userData}/>
        <div className="share-and-friend-container" style={{display:"flex"}}>
        <ShareComponent userData={userData}/>
        <SocialComponent userData={userData}/>
        <FriendComponent userData={userData}/>
        </div>
      </div>
    )

  }
}

export default App;
