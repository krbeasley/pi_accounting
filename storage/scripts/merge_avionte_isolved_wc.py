#!./.pi_venv/bin/python3

import argparse
import os
import datetime
import csv

parser = argparse.ArgumentParser()

parser.add_argument('--isolved', help='The path to the iSolved WC csv file.')
parser.add_argument('--avionte', help='The path to the Avionte WC csv file.')

STORAGE_DIR = os.path.dirname(os.path.abspath(os.curdir))
UPLOADS_DIR = os.path.join(STORAGE_DIR, 'uploads')
DOWNLOADS_DIR = os.path.join(STORAGE_DIR, 'downloads')
LOGS_DIR = os.path.join(STORAGE_DIR, 'logs')

merge_headers = ['Name', 'SSN', 'Total Hours']

if __name__ == "__main__":
    args = parser.parse_args()

    isolved=args.isolved
    avionte=args.avionte

    # List of employee data
    employee_data = []
    isolved_no = 0
    avionte_no = 0

    # Read the iSolved File
    with open(os.path.join(UPLOADS_DIR, isolved), mode='r') as file:
        reader = csv.reader(file)

        next(reader)
        # Get all the employee's name, ssn
        for row in reader:
            employee_data.append(row)
            isolved_no += 1

    # Read the Avionte File
    with open(os.path.join(UPLOADS_DIR, avionte), mode='r') as file:
        reader = csv.reader(file)

        next(reader)
        # Append any employee's who were not included in the iSolved file
        for row in reader:
            should_write = True
            for e in employee_data:
                if e[1] == row[1]:
                    if e[2] == row[2]:
                        should_write = False

            if should_write:
                employee_data.append(row)
                avionte_no += 1

    # Create the new csv
    now = datetime.datetime.now()
    new_file_name = f"{now.strftime('%d%m%Y')}_WC_Merge.csv" # File named like DDMMYYYY_WC_Merge.csv

    with open(os.path.join(DOWNLOADS_DIR, new_file_name), mode='w') as file:
        writer = csv.writer(file)

        writer.writerow(['name', 'ssn', 'total_hours'])
        for row in employee_data:
            writer.writerow([f"{row[0]} {row[1]}", row[2], row[3]])

    # Log details about the file merge
    with open(os.path.join(LOGS_DIR, 'worker.log'), mode='a+') as log_file:
        log_file.writelines([
            f"[{now.strftime('%d-%m-%Y %H:%M:%S')}] Merged Avionte and iSolved Worker's Compensation Claims\n",
            f"Processed {len(employee_data)} records.       iSolved [{isolved_no}]    Avionte [{avionte_no}]\n",
            f"iSolved: {isolved}    Avionte: {avionte}\n"
        ])


    # Return the download paths for the PHP script
    print(f"New File: storage/downloads/{new_file_name}")
