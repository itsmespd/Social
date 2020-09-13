import React from "react";
import Modal from "react-bootstrap/Modal";
import Button from "react-bootstrap/Button";

function ShareContentComponent(props) {
  const handleClose = () => props.handleShareOptionPopUpClose();

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
          Share Section{" "}
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <h4>Comment Section</h4>
        <p>List of Sharing options. Dev in progress</p>
      </Modal.Body>
      <Modal.Footer>
        <Button onClick={handleClose}>Close</Button>
      </Modal.Footer>
    </Modal>
  );
}

export default ShareContentComponent;
