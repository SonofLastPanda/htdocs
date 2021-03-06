# Format
# {ID,FROM,TO,Boarding,Qurantine,Vaccine,Regulation,Face Mask (Regulation),Public Transportation (Regulation)
#   ,Businesses (Regulation),Restaurants (Regulation),Reminder}																

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

ID = "SWE_IND"
FROM = "Sweden"
To = "India"

# Boarding
boarding = "NULL"

# Qurantine
qurantine = "NULL"

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