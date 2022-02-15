# Format
# {ID,FROM,TO,Boarding,Quarantine,Vaccine,Regulation,Face Mask (Regulation),Public Transportation (Regulation)
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
headers = {'User-Agent': 'Mozilla/5.0 (Linux; Android 5.1.1; SM-G928X Build/LMY47X) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36'}

ID = "SWE_HKG"
FROM = "Sweden"
To = "Hong Kong"

# Facemask
URL = "https://www.coronavirus.gov.hk/eng/public-transport-faq.html#:~:text=The%20Regulation%20requires%20that%20all,that%20is%20not%20in%20service)"
html_text = requests.get(URL, headers = headers)
soup = BeautifulSoup(html_text.content, 'lxml')
facemask = soup.find_all('li')
facemask = facemask[15].text # this is hardcoding, there should be better way to extract the information

# Boarding
URL = "https://www.coronavirus.gov.hk/eng/inbound-travel.html"
html_text = requests.get(URL, headers = headers)
soup = BeautifulSoup(html_text.content, 'lxml')
groupA = soup.find_all('table', class_ = "table table-bordered")
groupA = groupA[4] # for boarding requirement that fits sweden
boarding = groupA.find_all('td')[1] # can use smarter way to search the title "Boarding requirement:"
boarding = boarding.find_all('li')
boarding = [i.text for i in boarding]
boarding = "\n".join(boarding)

# Quarantine
quarantine = "NULL"
quarantine = groupA.find_all('td')[2]
quarantine = quarantine.find_all('li')
quarantine = [i.text for i in quarantine]
quarantine = "\n".join(quarantine)

# Vaccine
vaccine = "Yes"

# Regulation
# https://www.coronavirus.gov.hk/eng/social_distancing-faq.html
regulation = "NULL"

# Public Transportation
public_transportation = "Operating"

# Businesses
businesses = "Open"

# Restaurants
restaurants = "Open"

# Reminder
reminder = "NULL"