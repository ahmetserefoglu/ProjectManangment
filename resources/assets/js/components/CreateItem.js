import React, {Component} from 'react';
import {browserHistory} from 'react-router';

class CreateItem extends Component {
    constructor(props){
      super(props);
       
      this.state = {title : '',description : ''};

      this.handleChange1 = this.handleChange1.bind(this);
      this.handleChange2 = this.handleChange2.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
 
    }

    handleChange1(e){
    this.setState({
        title: e.target.value
      })
    }
    handleChange2(e){
      this.setState({
        description: e.target.value
      })
    }
    handleSubmit(e){
      e.preventDefault();
      const products = {
        title: this.state.title,
        description: this.state.description
      }
      let uri = 'http://127.0.0.1:8000/items';
      axios.post(uri, products).then((response) => {
        browserHistory.push('/display-item');
        //this.props.history.push("/");
      });
    }

    render() {
      return (
      <div>
        <h1>Create An Item</h1>
        <form onSubmit={this.handleSubmit}>
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label>Task Name:</label>
                <input type="text" className="form-control" onChange={this.handleChange1}/>
              </div>
            </div>
            </div>
            <div className="row">
              <div className="col-md-6">
                <div className="form-group">
                  <label>Task Description:</label>
                  <input type="text" className="form-control col-md-6" onChange={this.handleChange2}/>
                </div>
              </div>
            </div><br />
            <div className="form-group">
              <button className="btn btn-primary">Add Item</button>
            </div>
        </form>
  </div>
      )
    }
}
export default CreateItem;