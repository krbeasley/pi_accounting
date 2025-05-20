# Writing Successful Scripts For Pi Accounting

Below is a collection of tips I learned while creating the initial scripts for this app.

- Kyle

---

1. Scripts should be quick to return.
    - Don't make the PHP handler wait too long for a script response. 

    - Example: Say your script is generating a file for download and it's going to take a second to process. Your script should print or return the file path early in it's execution cycle so that the PHP handler can respond back to the user. The PHP handler can be configured with a delay on download links and respond accordingly.


