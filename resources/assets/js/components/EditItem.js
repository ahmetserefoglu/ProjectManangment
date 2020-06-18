
import React, {Component} from 'react';
import axios from 'axios';
import { browserHistory,Link } from 'react-router';


class EditItem extends Component {
  constructor(props) {
      super(props);
      this.state = {title: '', description: ''};
      this.handleChange1 = this.handleChange1.bind(this);
      this.handleChange2 = this.handleChange2.bind(this);
      this.handleSubmit = this.handleSubmit.bind(this);
  }

  componentDidMount(){
    axios.get(`http://127.0.0.1:8000/items/${this.props.params.id}/edit`)
    .then(response => {
      this.setState({ title: response.data.title, description: response.data.description });
    })
    .catch(function (error) {
      console.log(error);
    })
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

  handleSubmit(event) {
    event.preventDefault();
    const products = {
      title: this.state.title,
      description: this.state.description
    }
    let uri = 'http://127.0.0.1:8000/items/'+this.props.params.id;
    axios.patch(uri, products).then((response) => {
          this.props.history.push('/display-item');

    });
  }
  render(){
    return (
      <div>
        <h1>Update Item</h1>
        <div className="row">
          <div className="col-md-10"></div>
          <div className="col-md-2">
            <Link to="/display-item" className="btn btn-success">Return to Items</Link>
          </div>
        </div>
        <form onSubmit={this.handleSubmit}>
            <div className="form-group">
                <label>Item Name</label>
                <input type="text"
                  className="form-control"
                  value={this.state.title}
                  onChange={this.handleChange1} />
            </div>

            <div className="form-group">
                <label name="product_price">Item Description</label>
                <input type="text" className="form-control"
                  value={this.state.description}
                  onChange={this.handleChange2} />
            </div>

            <div className="form-group">
                <button className="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    )
  }
}
export default EditItem;