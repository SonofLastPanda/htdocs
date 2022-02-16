from django.db import models

# Create your models here.

def add_one():
    '''
    Returns the next default value for the `id` field, starts with
    Return with 500 if no item
    '''
    largest = Users.objects.all().order_by('user_id').last().user_id
    if not largest:
        return 500
    return largest + 1

class Users(models.Model):
    user_id= models.IntegerField(db_column='user_id', primary_key=True, default=add_one)
    age= models.IntegerField(db_column='age')
    email= models.CharField(db_column='email',max_length=45, blank=False)
    password= models.CharField(db_column='password',max_length=45, blank=False)
    citizenship= models.CharField(db_column='citizenship',max_length=45, blank=True)
    class Meta:
        managed = False
        db_table = 'Users'

class Country(models.Model):
    country_id=models.IntegerField(db_column="country_id", primary_key=True, default=add_one)
    country_name=models.CharField(db_column="country_name",max_length=125)
    class Meta:
        managed = False
        db_table = 'Country'
class Regulations(models.Model):
    country_id=models.ForeignKey('Country', models.DO_NOTHING)
    country_name=models.CharField(db_column= 'country_name', max_length=125)
    regulations= models.TextField(db_column='regulations',blank=True)
    class Meta:
        managed=False
        db_table='Regulations'

