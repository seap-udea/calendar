clean:
	touch delete.pyc delete~
	rm -r *.pyc
	find . -name "*~" -exec rm {} \;

commit:
	@echo "Commiting changes..."
	@-git commit -am "Commit"
	@git push origin master

pull:
	@echo "Pulling from repository..."
	@git reset --hard HEAD	
	@git pull
	@chown -R www-data.www-data .
