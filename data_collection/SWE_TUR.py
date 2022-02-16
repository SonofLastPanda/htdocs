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

URL = 'https://www.visasturkey.com/vaccinations-for-turkey/'
html_text = requests.get(URL)
soup = BeautifulSoup(html_text.content, 'lxml')
print(soup.find('h1'))