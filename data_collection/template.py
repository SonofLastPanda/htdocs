# Format
# {ID,FROM,TO,Boarding,Quarantine,Vaccine,Regulation,Face Mask (Regulation),Public Transportation (Regulation)
#   ,Businesses (Regulation),Restaurants (Regulation),Reminder}																
'''
import requests
from bs4 import BeautifulSoup
from requests.adapters import HTTPAdapter
from requests.packages.urllib3.util.retry import Retry

# use session to retry three times if the connection fail
session = requests.Session()
retry = Retry(connect=3, backoff_factor=0.5)
adapter = HTTPAdapter(max_retries=retry)
session.mount('http://', adapter)
session.mount('https://', adapter)
headers = {'User-Agent': 'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36'}
'''
from retry import *

ID = "template"
FROM = "Sweden"
To = "template"

# Boarding
URL = "your url"
html_text = requests.get(URL, headers = headers)
soup = BeautifulSoup(html_text.content, 'lxml')
boarding = "NULL"

# Quarantine
quarantine = "NULL"

# Vaccine
vaccine = "NULL"


# Regulation
regulation = "NULL"

# Facemask
facemask = "NULL"

# Public Transportation
public_transportation = "NULL"

# Businesses
businesses = "NULL"

# Restaurants
restaurants = "NULL"

# Reminder
reminder = "NULL"