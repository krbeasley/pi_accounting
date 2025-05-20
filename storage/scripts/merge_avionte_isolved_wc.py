#!./.pi_venv/bin/python3

import csv
import os
import argparse
import Common

# Script Arguments
parser = argparse.ArgumentParser()
parser.add_argument('avionte', help='The filepath for the Avionte WC Export', default=None)
parser.add_argument('isolved', help='The filepath for the iSolved WC Export', default=None)

# Main program
if __name__ == "__main__":
    args = parser.parse_args()

    if args.avionte is None or args.isolved is None:
        # You left off here.
        # Make a script that combines the two WC exports. 
        pass
