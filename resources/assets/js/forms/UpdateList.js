import React,{Component} from 'react';
import UserConsumer from '../context';
import axios from 'axios';
import { browserHistory,Link } from 'react-router';

class UpdateList extends Component {
	
	state={
	   name : "",
	   meslek : "",
	   gorevi : "",
	   maasi : "",
     error : ""
	}

	changeInput = (e) => {
	  this.setState({
	    //name = "name"
	    [e.target.name] : e.target.value
	  })

	}

  validateForm = () => {
    const {name,meslek,gorevi,maasi} = this.state;

    if(name === "" || meslek === "" || gorevi === "" || maasi === ""){
      return false;
    }

    return true;
  }

	componentDidMount = async () => {
		const {id} = this.props.match.params;

		const response = await axios.get(`http://localhost:3004/users/${id}`);

		const {name,meslek,gorevi,maasi} = response.data;

		this.setState({
			name,
			meslek,
			gorevi,
			maasi
		})
	}

	editUser = async (dispatch,e) => {
   	 e.preventDefault();
    //console.log("Update User");
    const {id} = this.props.match.params;
    
    const {name,meslek,gorevi,maasi} = this.state;

    const updatedUser = {
    	name,
    	meslek,
    	gorevi,
    	maasi
    };

    if(!this.validateForm()){
      this.setState({
        error: true
      })

      return;
    }
    
    const response = await axios.put(`http://127.0.0.1:8000/reactuser/${id}`,updatedUser);

    dispatch({type:"UPDATE_USER",payload:response.data});


    //Redirect
    browserHistory.push('/list');
    console.log(updatedUser);

  	}

  render() {
    const {name,meslek,gorevi,maasi,error} = this.state;
    return <UserConsumer>
    {
      value =>{
        const {dispatch} = value;

        return (
          <div className = "col-md-8 mb-4">

          
          <div className="card">
          <div className="card-header">
          <h4>Update User</h4>
          <div className="card-body">
          {
            error ? 
            <div className="alert alert-danger">
              Lütfen Bilgilerinizi Kontrol Edin
            </div>
            :null
          }
          <form onSubmit= {this.editUser.bind(this,dispatch)}>
          <div className="form-group">
          <label htmlFor="name">Name</label>
          <input type="text" name = "name" id="name" placeholder="Adınız" className="form-control" value = {name}
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="meslek">Job</label>
          <input type="text" name = "meslek" id="meslek" placeholder="Enter Job" className="form-control" value = {meslek} 
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="gorevi">Department</label>
          <input type="text" name = "gorevi" id="gorevi" placeholder="Enter Department" className="form-control" value = {gorevi} 
          onChange = {this.changeInput}/>
          </div>
          <div className="form-group">
          <label htmlFor="maasi">Salary</label>
          <input type="text" name = "maasi" id="maasi" placeholder="Ente Salary" className="form-control" value = {maasi} 
          onChange = {this.changeInput}/>
          </div>
          <button className="btn btn-danger btn-block" type="submit">Update User</button>
          </form>
          </div>
          </div>
          </div>
          </div>
          )

      }
    }
    </UserConsumer>
    
    
  }

}

export default UpdateList;