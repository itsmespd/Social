import React from "react";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";

function CommentComponent(props) {
  const handleClose = () => props.handleCommentBoxPopUpClose();

  return (
    <Modal
      size="lg"
      aria-labelledby="contained-modal-title-vcenter"
      centered
      show={props.isOpen === true}
      onHide={handleClose}
      backdrop="static"
      keyboard={false}
    >
      <Modal.Header closeButton>
        <Modal.Title id="contained-modal-title-vcenter">
          Check the Comments
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        {/* <h4>Comment Section</h4> */}
        <p>List of Comments form your friends o be shown. Dev in progress</p>
      </Modal.Body>
      <Modal.Footer>
        <Button onClick={handleClose}>Close</Button>
      </Modal.Footer>
    </Modal>
  );
}

export default CommentComponent;
