from os import name, system
from json import dumps

class Response:
    """
    The base response object. Can be extended to create custom response types. 
    Allows for standardized communication between PHP and Python processes. It may look
    a lot like JSON, and that's because it is. 
    """
    def __init__(self, code = 200, message = "", files = []):
        """
        Construct a new Response object.

        :param code: The status code of the response. Mirror HTTP response codes.
        :param message: The message of the response. Similar to how a REST API would respond.
        :param files: List of filepaths where resources are or will be located.
        """
        self.code = code
        self.message = message 
        self.files = files 

    def addFilepath(self, filepath):
        """
        Add a new filepath to the response object's files list.

        Alternate to ResponseObject.files.append(filepath)

        :param filepath: The filepath to add
        """
        self.files.append(str(filepath))

    def __str__(self):
        """
        Custom JSON-like readable representation. Used when print()-ing the Response object.
        """
        return dumps({
            "code" : self.code,
            "message" : self.message,
            "files" : self.files
        })    

def clear():
    """
    Clear the terminal screen
    """
    system('cls') if name == 'nt' else system('clear')
