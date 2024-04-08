function submitForm(event) {
    event.preventDefault();
  
    // Get form values
    const feedbackType = document.querySelector('input[name="feedbackType"]:checked');
    const description = document.getElementById('description');
    const anonymity = document.getElementById('anonymity');
  
    // Check if all fields are filled
    if (!feedbackType || !description || !anonymity.checked) {
      alert("Please fill in all fields and confirm anonymity.");
      return;
    }
  
    // Create feedback object
    const feedback = {
      type: feedbackType.value,
      description: description.value,
      anonymity: anonymity.checked
    };
  
    // For demonstration, you can log the feedback object to the console
    console.log(feedback);
  
    // For a real application, you would submit this feedback object to your server via AJAX
    // Example:
    // fetch('url_to_your_server', {
    //   method: 'POST',
    //   headers: {
    //     'Content-Type': 'application/json',
    //   },
    //   body: JSON.stringify(feedback),
    // })
    // .then(response => response.json())
    // .then(data => {
    //   // Handle success or show confirmation message
    //   console.log('Success:', data);
    // })
    // .catch((error) => {
    //   console.error('Error:', error);
    // });
  
    // For this example, just show an alert for successful submission
    alert("Feedback submitted successfully!");
    document.getElementById('feedbackForm').reset(); // Clear form fields
  }
  