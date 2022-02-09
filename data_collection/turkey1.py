import requests
from bs4 import BeautifulSoup
from requests.adapters import HTTPAdapter
from requests.packages.urllib3.util.retry import Retry

session = requests.Session()
retry = Retry(connect=3, backoff_factor=0.5)
adapter = HTTPAdapter(max_retries=retry)
session.mount('http://', adapter)
session.mount('https://', adapter)

URL = "https://www.visasturkey.com/travel-and-entry-restrictions/"
html_text = requests.get(URL)
soup = BeautifulSoup(html_text.content, 'lxml')

types = [type.text for type in soup.find_all('h2')]

print(html_text.content)