import React, { Component } from 'react';
import List from "./List.js";
/*import PropTypes from 'prop-types';*/
import UserConsumer from '../context';

class Lists extends Component {
  render() {
    /*const {users,deleteUser} = this.props;
    console.log(users);*/

    return (
      <UserConsumer>
      {
        value => {
          const {users} = value;
          return (
            <div>
            {
              users.map(user => {
                return(
                  <List
                  key= {user.id}
                  id= {user.id}
                  name = {user.name}
                  meslek = {user.meslek}
                  gorevi = {user.gorevi}
                  maasi = {user.maasi}
                  />
                  )
              })
            }
            </div>
            );
        }
      }
      </UserConsumer>
      )
    
  }
}

/*List.propTypes ={
  deleteUser: PropTypes.func.isRequired
}*/

export default Lists;
