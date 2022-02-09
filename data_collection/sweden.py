import requests
from bs4 import BeautifulSoup
from requests.adapters import HTTPAdapter
from requests.packages.urllib3.util.retry import Retry

session = requests.Session()
retry = Retry(connect=3, backoff_factor=0.5)
adapter = HTTPAdapter(max_retries=retry)
session.mount('http://', adapter)
session.mount('https://', adapter)


URL = "https://polisen.se/en/the-swedish-police/the-coronavirus-and-the-swedish-police/travel-to-and-from-sweden/#exempted"
html_text = requests.get(URL)

soup = BeautifulSoup(html_text.content, 'lxml')
editorals = soup.find('div', class_ = 'editorial-html')

types = [type.text for type in editorals.find_all('h3')]
contents = [content.text for content in editorals.find_all('ul')]

restrictions = dict(zip(types, contents))

print(types)

for i in range(len(contents)):
    print (f"""
Types: {types[i]}
Content: {contents[i]}
""")

'''
for i in range(len(types)):
    with open(f'sweden.txt', "a") as f:
        f.write(f"""
Types: {types[i]}
Content: {contents[i]}
""")
'''