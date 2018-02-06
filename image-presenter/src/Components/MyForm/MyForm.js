import React from "react";
import { Form, Text } from "react-form";
import axios from "axios";
import "./MyForm.css";

class MyForm extends React.Component {
  constructor(props) {
    super(props);
    this.state = { images: [""] };
    this.validateUrl = this.validateUrl.bind(this);
    this.showImages = this.showImages.bind(this);
  }

  validateUrl = url => {
    axios({
      method: "post",
      url: "http://localhost:4433/api/getImagesFromURL.php",
      data: { url }
    })
      .then(response => {
        const { message, images } = response.data;
        console.log(message);
        if (message) {
          const filteredImages = [...new Set(images)];
          console.log(images);
          this.setState({ message, images: filteredImages });
        }
      })
      .catch(e => `hello + ${e}`);
  };

  showImages = images => (
    <div>
      {images.map(image => (
        <div key={image}>
          <img src={image} alt={image} />
        </div>
      ))}
    </div>
  );

  render() {
    return (
      <div className="formHolder">
        <Form onSubmit={this.validateUrl}>
          {formApi => (
            <form onSubmit={formApi.submitForm} id="getUrlForm">
              <label htmlFor="url" className="formLabel">
                Feed me VALID url!
                <Text field="url" id="url" className="urlInput" />
                <span className="error">{this.state.message}</span>
                {this.showImages(this.state.images)}
              </label>
              <button type="submit" className="submitButton">
                Submit
              </button>
            </form>
          )}
        </Form>
      </div>
    );
  }
}

export default MyForm;
